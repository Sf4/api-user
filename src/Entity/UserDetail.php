<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.01.19
 * Time: 10:04
 */

namespace Sf4\ApiUser\Entity;

use Sf4\Api\Entity\EntityInterface;
use Sf4\Api\Entity\Traits\EntityIdTrait;

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
}
