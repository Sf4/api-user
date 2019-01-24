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
    const STATUS_CODE_ACTIVE = 'active';
    const STATUS_CODE_INACTIVE = 'inactive';
    const STATUS_CODE_ARCHIVED = 'archived';
    const STATUS_CODE_PENDING = 'pending';
}
