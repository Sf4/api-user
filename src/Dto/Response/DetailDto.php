<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 22.01.19
 * Time: 7:45
 */

namespace Sf4\ApiUser\Dto\Response;

use Sf4\Api\Dto\DtoInterface;

class DetailDto implements DtoInterface
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public $id;

    public $email;

    public $roles;

    public $firstName;

    public $lastName;

    public $avatar;

    public $status;

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
}
