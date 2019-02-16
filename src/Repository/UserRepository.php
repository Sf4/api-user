<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 23.01.19
 * Time: 8:29
 */

namespace Sf4\ApiUser\Repository;

use Sf4\Api\Repository\AbstractRepository;
use Sf4\ApiUser\Entity\User;

class UserRepository extends AbstractRepository
{
    const TABLE_NAME = 'user';

    protected function getEntityClass(): string
    {
        return User::class;
    }
}
