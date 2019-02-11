<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 1.02.19
 * Time: 9:10
 */

namespace Sf4\ApiUser\Entity\Traits\User;

trait PublicTrait
{
    protected $email;

    protected $roles;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        if (false === in_array('ROLE_USER', $this->roles)) {
            $this->roles[] = 'ROLE_USER';
        }

        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }
}
