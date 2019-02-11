<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 31.01.19
 * Time: 12:23
 */

namespace Sf4\ApiUser\Dto\Order;

use Sf4\Api\Dto\Order\AbstractOrder;
use Sf4\ApiUser\Entity\UserDetailFieldInterface;
use Sf4\ApiUser\Entity\UserFieldsInterface;

class ListOrder extends AbstractOrder implements UserFieldsInterface, UserDetailFieldInterface
{

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
