<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.01.19
 * Time: 18:48
 */

namespace Sf4\ApiUser\Request;

use Sf4\Api\Request\AbstractRequest;
use Sf4\ApiUser\CacheAdapter\CacheKeysInterface;
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

    /**
     * @param \Closure $closure
     * @param string|null $cacheKey
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getCachedResponse(\Closure $closure, string $cacheKey = null)
    {
        if (null === $cacheKey) {
            $request = $this->getRequest();
            $id = $request->attributes->get('id');
            $cacheKey = CacheKeysInterface::KEY_USER_DETAIL . $id;
        }
        parent::getCachedResponse($closure, $cacheKey);
    }
}
