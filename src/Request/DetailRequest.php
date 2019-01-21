<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.01.19
 * Time: 18:48
 */

namespace Sf4\ApiUser\Request;

use Sf4\Api\Request\AbstractRequest;
use Sf4\ApiUser\Response\DetailResponse;

class DetailRequest extends AbstractRequest
{
    const ROUTE = 'api_user_detail';

    public function __construct()
    {
        $this->init(
            new DetailResponse()
        );
    }
}
