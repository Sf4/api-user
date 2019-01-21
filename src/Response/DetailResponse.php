<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.01.19
 * Time: 18:50
 */

namespace Sf4\ApiUser\Response;

use Sf4\Api\Response\AbstractResponse;

class DetailResponse extends AbstractResponse
{

    public function init()
    {
        $data = [
            'message' => 'User detail'
        ];
        $this->setData($data);
    }
}
