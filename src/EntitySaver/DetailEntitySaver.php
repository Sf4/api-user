<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 7.02.19
 * Time: 8:51
 */

namespace Sf4\ApiUser\EntitySaver;

use Sf4\Api\Dto\DtoInterface;
use Sf4\Api\Entity\EntityInterface;
use Sf4\Api\EntitySaver\AbstractEntitySaver;
use Sf4\Api\Notification\BaseErrorMessage;
use Sf4\Api\Notification\BaseNotification;
use Sf4\Api\Notification\NotificationInterface;
use Sf4\Api\Utils\Traits\SerializerTrait;
use Sf4\ApiUser\Entity\UserDetailInterface;
use Sf4\ApiUser\Entity\UserInterface;
use Sf4\ApiUser\EntityValidator\DetailEntityValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DetailEntitySaver extends AbstractEntitySaver
{

    use SerializerTrait;

    const MESSAGE_INVALID_ENTITY = 'user.detail.validate.invalid_entity';

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

    protected function validate(EntityInterface $entity, ValidatorInterface $validator): NotificationInterface
    {
        $notification = new BaseNotification();
        if ($entity instanceof UserInterface) {
            $entityValidator = new DetailEntityValidator();
            $entityValidator->setTranslator($this->getResponse()->getRequest()->getRequestHandler()->getTranslator());
            $entityValidator->validate($entity, $validator, $notification);
        } else {
            $errorMessage = new BaseErrorMessage();
            $errorMessage->setKey('entity');
            $errorMessage->setMessage(
                $this->getResponse()->translate(
                    static::MESSAGE_INVALID_ENTITY
                )
            );
            $notification->addMessage($errorMessage);
        }

        return $notification;
    }
}
