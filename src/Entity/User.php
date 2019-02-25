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
use Sf4\ApiUser\Entity\Traits\UserTrait;

/**
 * @ORM\Entity(repositoryClass="Sf4\ApiUser\Repository\UserRepository")
 * @ORM\Table(indexes={
 *     @ORM\Index(name="email_idx", columns={"email"})
 * })
 */
class User implements EntityInterface, UserInterface, UserFieldsInterface, TimestampableInterface
{
    use UserTrait;
}
