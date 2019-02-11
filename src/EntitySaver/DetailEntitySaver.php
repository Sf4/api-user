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
use Sf4\ApiUser\Entity\User;
use Sf4\ApiUser\Entity\UserDetail;
use Sf4\ApiUser\EntityValidator\DetailEntityValidator;
use Sf4\Populator\Populator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DetailEntitySaver extends AbstractEntitySaver
{

    const MESSAGE_INVALID_ENTITY = 'user.detail.validate.invalid_entity';

    protected function populateEntity(EntityInterface $entity, DtoInterface $requestDto)
    {
        if ($entity instanceof User) {
            /** @var UserDetail $userDetail */
            $userDetail = $entity->getUserDetail();

            $data = $requestDto->toArray();
            $populator = new Populator();
            try {
                $populator->populate($data, $entity);
                $populator->populate($data, $userDetail);
            } catch (\ReflectionException $e) {
                return ;
            }
        }
    }

    protected function validate(EntityInterface $entity, ValidatorInterface $validator): NotificationInterface
    {
        $notification = new BaseNotification();
        if ($entity instanceof User) {
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
