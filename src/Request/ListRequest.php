<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 25.01.19
 * Time: 7:58
 */

namespace Sf4\ApiUser\Request;

use Sf4\Api\Request\AbstractRequest;
use Sf4\ApiUser\Dto\Request\ListDto;
use Sf4\ApiUser\Response\ListResponse;

class ListRequest extends AbstractRequest
{
    const ROUTE = 'api_user_list';

    public function __construct()
    {
        $this->init(
            new ListResponse(),
            new ListDto()
        );
    }
}
