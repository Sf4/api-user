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
    const FIELD_ID = 'id';
    const FIELD_UUID = 'uuid';
    const FIELD_EMAIL = 'email';
    const FIELD_STATUS = 'status';
    const FIELD_PASS = 'password';
    const FIELD_API_TOKEN = 'api_token';
    const FIELD_ROLES = 'roles';
    const FIELD_DELETED_AT = 'deleted_at';
    const FIELD_CREATED_AT = 'created_at';
    const FIELD_USER_DETAIL = 'userDetail';
}
