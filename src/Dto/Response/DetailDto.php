<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 22.01.19
 * Time: 7:45
 */

namespace Sf4\ApiUser\Dto\Response;

use Sf4\Api\Dto\AbstractDto;

class DetailDto extends AbstractDto
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $id;

    protected $email;

    protected $roles;

    protected $firstName;

    protected $lastName;

    protected $avatar;

    protected $status;

    public function getStatusCode()
    {
        return $this->status == 1 ? static::STATUS_ACTIVE : static::STATUS_INACTIVE;
    }

    public function getAvatarOrDefault()
    {
        if(empty($this->avatar)) {
            return 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
        }

        return $this->avatar;
    }

    public function getRolesArray(): ?array
    {
        return json_decode($this->roles);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['status'] = $this->getStatusCode();
        $data['avatar'] = $this->getAvatarOrDefault();
        $data['roles'] = $this->getRolesArray();

        return $data;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
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

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
}
