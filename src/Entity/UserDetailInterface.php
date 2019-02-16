<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 16.02.19
 * Time: 17:22
 */

namespace Sf4\ApiUser\Entity;

interface UserDetailInterface
{
    public function getFullName();

    public function getFirstName();

    public function setFirstName($firstName);

    public function getLastName();

    public function setLastName($lastName);

    public function getAvatar();

    public function setAvatar($avatar);
}
