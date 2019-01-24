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
}
