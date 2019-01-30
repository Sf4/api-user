<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 25.01.19
 * Time: 9:58
 */

namespace Sf4\ApiUser\Dto\Response;

use Sf4\Api\Dto\Response\AbstractResponseListDto;

class ListDto extends AbstractResponseListDto
{

    public function getListItemClass(): string
    {
        return ListItemDto::class;
    }
}
