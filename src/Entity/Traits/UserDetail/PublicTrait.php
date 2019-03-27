<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 1.02.19
 * Time: 9:15
 */

namespace Sf4\ApiUser\Entity\Traits\UserDetail;

trait PublicTrait
{
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

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }
}
