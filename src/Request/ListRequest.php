<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 25.01.19
 * Time: 7:58
 */

namespace Sf4\ApiUser\Request;

use Sf4\Api\Request\AbstractRequest;
use Sf4\ApiUser\CacheAdapter\CacheKeysInterface;
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

    /**
     * @param \Closure $closure
     * @param string|null $cacheKey
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getCachedResponse(\Closure $closure, string $cacheKey = null)
    {
        if (null === $cacheKey) {
            $cacheKey = CacheKeysInterface::KEY_USER_LIST;
        }
        parent::getCachedResponse($closure, $cacheKey);
    }
}
