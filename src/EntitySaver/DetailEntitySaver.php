<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 7.02.19
 * Time: 8:51
 */

namespace Sf4\ApiUser\EntitySaver;

use Psr\Cache\InvalidArgumentException;
use Sf4\Api\Dto\DtoInterface;
use Sf4\Api\Entity\EntityInterface;
use Sf4\Api\EntitySaver\AbstractEntitySaver;
use Sf4\Api\Notification\BaseErrorMessage;
use Sf4\Api\Notification\BaseNotification;
use Sf4\Api\Notification\NotificationInterface;
use Sf4\Api\Utils\Traits\SerializerTrait;
use Sf4\ApiUser\CacheAdapter\CacheKeysInterface;
use Sf4\ApiUser\Entity\UserDetailInterface;
use Sf4\ApiUser\Entity\UserInterface;
use Sf4\ApiUser\EntityValidator\DetailEntityValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DetailEntitySaver extends AbstractEntitySaver
{

    use SerializerTrait;

    public const MESSAGE_INVALID_ENTITY = 'user.detail.validate.invalid_entity';

    /**
     * @param EntityInterface $entity
     * @param DtoInterface $requestDto
     */
    protected function populateEntity(EntityInterface $entity, DtoInterface $requestDto)
    {
        if ($entity instanceof UserInterface) {
            /** @var UserDetailInterface $userDetail */
            $userDetail = $entity->getUserDetail();

            $data = $requestDto->toArray();

            $this->populateObject($data, $entity);
            $this->populateObject($data, $userDetail);
        }
    }

    /**
     * @param EntityInterface $entity
     * @param ValidatorInterface $validator
     * @return NotificationInterface
     */
    protected function validate(EntityInterface $entity, ValidatorInterface $validator): NotificationInterface
    {
        $notification = new BaseNotification();
        if ($entity instanceof UserInterface) {
            $entityValidator = new DetailEntityValidator();
            $requestHandler = $this->getRequestHandler();
            if ($requestHandler) {
                $entityValidator->setTranslator($requestHandler->getTranslator());
                $entityValidator->validate($entity, $validator, $notification);
            }
        } else {
            $errorMessage = new BaseErrorMessage();
            $errorMessage->setKey('entity');
            $response = $this->getResponse();
            if ($response) {
                $errorMessage->setMessage(
                    $response->translate(
                        static::MESSAGE_INVALID_ENTITY
                    )
                );
            }
            $notification->addMessage($errorMessage);
        }

        return $notification;
    }

    /**
     * @param EntityInterface $entity
     * @throws InvalidArgumentException
     */
    protected function postEntitySave(EntityInterface $entity)
    {
        if ($entity instanceof UserInterface) {
            $uuid = $entity->getUuid();
            $cacheKey = CacheKeysInterface::KEY_USER_DETAIL . $uuid;
            $requestHandler = $this->getRequestHandler();
            if ($requestHandler) {
                $requestHandler->removeByKey($cacheKey);
                $requestHandler->removeByTag([
                    CacheKeysInterface::TAG_USER_DETAIL,
                    CacheKeysInterface::TAG_USER_LIST
                ]);
            }
        }
    }
}
