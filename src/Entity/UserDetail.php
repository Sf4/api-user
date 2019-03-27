<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.01.19
 * Time: 10:04
 */

namespace Sf4\ApiUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sf4\Api\Entity\EntityInterface;
use Sf4\Api\Entity\Traits\EntityIdTrait;
use Sf4\ApiUser\Entity\Traits\UserDetail\PublicTrait;

/**
 * @ORM\Entity(repositoryClass="Sf4\ApiUser\Repository\UserDetailRepository")
 */
class UserDetail implements EntityInterface, UserDetailInterface, UserDetailFieldInterface
{
    use EntityIdTrait;
    use PublicTrait;
}
