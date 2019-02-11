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
class UserDetail implements EntityInterface, UserDetailFieldInterface
{
    use EntityIdTrait;
    use PublicTrait;

    /**
     * @ORM\Column(type="string", length=100, options={"default" : ""})
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=100, options={"default" : ""})
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=255, options={"default" : ""})
     */
    protected $avatar;
}
