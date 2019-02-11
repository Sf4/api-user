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
    protected $firstName;

    protected $lastName;

    protected $avatar;

    public function getFullName()
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

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
}
