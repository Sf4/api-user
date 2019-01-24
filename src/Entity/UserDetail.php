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

/**
 * @ORM\Entity(repositoryClass="Sf4\ApiUser\Repository\UserDetailRepository")
 */
class UserDetail implements EntityInterface
{
    use EntityIdTrait;

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

    public function getFullName(): string
    {
        $fullName = $this->getFirstName() . ' ' . $this->getLastName();
        if ($fullName === ' ') {
            $fullName = '';
        }

        return $fullName;
    }

    public function getFirstName(): string
    {
        if ($this->firstName === null) {
            $this->firstName = '';
        }

        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        if ($this->lastName === null) {
            $this->lastName = '';
        }

        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }
}
