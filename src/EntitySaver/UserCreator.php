<?php

namespace Sf4\ApiUser\EntitySaver;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Sf4\Api\Setting\StatusSettingInterface;
use Sf4\Api\Utils\Traits\EntityManagerTrait;
use Sf4\Api\Utils\Traits\SerializerTrait;
use Sf4\ApiUser\Entity\User;
use Sf4\ApiUser\Entity\UserDetail;
use Sf4\ApiUser\Entity\UserInterface;

class UserCreator
{
    use SerializerTrait;
    use EntityManagerTrait;

    /**
     * UserCreator constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @return UserInterface
     * @throws Exception
     */
    public function create(array $data): UserInterface
    {
        $user = new User();
        $user->createUuid();
        $user->setCreatedAt(new DateTime());
        $user->setUpdatedAt(new DateTime());
        $user->setStatus(StatusSettingInterface::PENDING);
        $user->setPassword($user->createNewToken());
        $user->setRoles([
            'ROLE_USER'
        ]);
        $user->setGoogleId('');
        $this->populateObject($data, $user);

        if (array_key_exists('create_api_token', $data)) {
            $user->setApiToken(
                $user->createNewToken()
            );
        }

        $userDetail = new UserDetail();
        $userDetail->createUuid();
        $userDetail->setAvatar('');
        $this->populateObject($data, $userDetail);

        $user->setUserDetail($userDetail);

        $entityManager = $this->getEntityManager();
        $entityManager->persist($userDetail);
        $entityManager->persist($user);
        $entityManager->flush();

        if ($user instanceof UserInterface) {
            $entityManager->refresh($user);
            $user = $entityManager->merge($user);
        }

        return $user;
    }
}
