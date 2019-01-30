<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 25.01.19
 * Time: 16:03
 */

namespace Sf4\ApiUser\Dto\Response;

use Sf4\Api\Dto\AbstractDto;
use Sf4\ApiUser\Dto\Traits\DetailBaseTrait;
use Sf4\ApiUser\Dto\Traits\DetailToArrayTrait;

class ListItemDto extends AbstractDto
{
    use DetailToArrayTrait;
    use DetailBaseTrait;

    public function toArray(): array
    {
        $data = parent::toArray();
        return $this->detailToArray($data);
    }
}
