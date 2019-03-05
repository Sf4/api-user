<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 4.02.19
 * Time: 9:25
 */

namespace Sf4\ApiUser\Request;

use Sf4\Api\Request\AbstractRequest;
use Sf4\ApiUser\Dto\Request\SaveDetailDto;
use Sf4\ApiUser\Response\SaveDetailResponse;

class SaveDetailRequest extends AbstractRequest
{
    const ROUTE = 'sf4_api_user_save_detail';

    public function __construct()
    {
        $this->init(
            new SaveDetailResponse(),
            new SaveDetailDto()
        );
    }

    protected function getCacheTags(): array
    {
        return [];
    }

    protected function getCacheKey(): ?string
    {
        return null;
    }
}
