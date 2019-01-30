<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 22.01.19
 * Time: 7:45
 */

namespace Sf4\ApiUser\Dto\Response;

use Sf4\Api\Dto\AbstractDto;
use Sf4\ApiUser\Dto\Traits\DetailToArrayTrait;
use Sf4\ApiUser\Dto\Traits\DetailTrait;

class DetailDto extends AbstractDto implements DetailDtoInterface
{
    use DetailTrait;
    use DetailToArrayTrait;

    public function toArray(): array
    {
        return $this->detailToArray(parent::toArray());
    }
}
