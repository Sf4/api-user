<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 28.01.19
 * Time: 7:11
 */

namespace Sf4\ApiUser\Dto\Request;

use Sf4\Api\Dto\Request\AbstractRequestListDto;
use Sf4\ApiUser\Dto\Filter\ListFilter;

class ListDto extends AbstractRequestListDto
{

    protected function getFilterClass(): string
    {
        return ListFilter::class;
    }
}
