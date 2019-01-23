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
    public $uuid;

    public $email;

    public $roles;

    public $firstName;

    public $lastName;

    public $avatar;

    public $status;
}
