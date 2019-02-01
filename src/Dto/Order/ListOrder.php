<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 31.01.19
 * Time: 12:23
 */

namespace Sf4\ApiUser\Dto\Order;

use Sf4\Api\Dto\Order\AbstractOrder;

class ListOrder extends AbstractOrder
{
    const FIELD_ID = 'id';
    const FIELD_EMAIL = 'email';
    const FIELD_FIRST_NAME = 'firstName';
    const FIELD_LAST_NAME = 'lastName';
    const FIELD_STATUS = 'status';

    public function getAvailableFields(): array
    {
        return [
            static::FIELD_ID,
            static::FIELD_EMAIL,
            static::FIELD_FIRST_NAME,
            static::FIELD_LAST_NAME,
            static::FIELD_STATUS
        ];
    }
}
