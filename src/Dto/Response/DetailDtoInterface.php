<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 24.01.19
 * Time: 18:31
 */

namespace Sf4\ApiUser\Dto\Response;

interface DetailDtoInterface
{
    public const STATUS_CODE_ACTIVE = 'active';
    public const STATUS_CODE_INACTIVE = 'inactive';
    public const STATUS_CODE_ARCHIVED = 'archived';
    public const STATUS_CODE_PENDING = 'pending';
}
