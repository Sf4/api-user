<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.01.19
 * Time: 18:50
 */

namespace Sf4\ApiUser\Response;

use Sf4\Api\Response\AbstractResponse;
use Sf4\ApiUser\Dto\Response\DetailDto;
use Sf4\Populator\Populator;

class DetailResponse extends AbstractResponse
{

    public function init()
    {
        $populator = new Populator();
        $dto = new DetailDto();
        $dto->uuid = 'uui';
        $dto->email = 'email';
        $dto->roles = ['SUPER_ADMIN', 'ROLE_USER'];
        $dto->firstName = 'First';
        $dto->lastName = 'Last';
        $dto->status = 'active';
        $dto->avatar = 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
        $data = $populator->unpopulate($dto);
        $this->setData($data);
    }
}
