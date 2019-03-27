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
    /** @ORM\Column(type="string", length=180, unique=true) */
    protected $email;

    /**
     * @ORM\Column(type="json")
     */
    protected $roles;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        if (false === in_array('ROLE_USER', $this->roles, true)) {
            $this->roles[] = 'ROLE_USER';
        }

        return $this->roles;
    }

    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }
}
