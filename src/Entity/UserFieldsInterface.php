<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 10.02.19
 * Time: 14:13
 */

namespace Sf4\ApiUser\Entity;

interface UserFieldsInterface
{
    public const FIELD_ID = 'id';
    public const FIELD_UUID = 'uuid';
    public const FIELD_EMAIL = 'email';
    public const FIELD_STATUS = 'status';
    public const FIELD_PASS = 'password';
    public const FIELD_API_TOKEN = 'api_token';
    public const FIELD_ROLES = 'roles';
    public const FIELD_DELETED_AT = 'deleted_at';
    public const FIELD_CREATED_AT = 'created_at';
    public const FIELD_USER_DETAIL = 'userDetail';
}
