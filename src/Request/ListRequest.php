<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 25.01.19
 * Time: 7:58
 */

namespace Sf4\ApiUser\Request;

use Closure;
use Psr\Cache\CacheException;
use Psr\Cache\InvalidArgumentException;
use Sf4\Api\Request\AbstractRequest;
use Sf4\ApiUser\CacheAdapter\CacheKeysInterface;
use Sf4\ApiUser\Dto\Request\ListDto;
use Sf4\ApiUser\Response\ListResponse;

class ListRequest extends AbstractRequest
{
    public const ROUTE = 'sf4_api_user_list';

    public function __construct()
    {
        $this->init(
            new ListResponse(),
            new ListDto()
        );
    }

    /**
     * @param Closure $closure
     * @param string|null $cacheKey
     * @param array $tags
     * @param int|null $expiresAfter
     * @throws CacheException
     * @throws InvalidArgumentException
     */
    public function getCachedResponse(
        Closure $closure,
        string $cacheKey = null,
        array $tags = [],
        int $expiresAfter = null
    ) {
        if (null === $cacheKey) {
            $cacheKey = CacheKeysInterface::KEY_USER_LIST;
        }
        parent::getCachedResponse($closure, $cacheKey, $tags, $expiresAfter);
    }

    protected function getCacheTags(): array
    {
        return [
            CacheKeysInterface::TAG_USER_LIST,
            CacheKeysInterface::TAG_USER
        ];
    }
}
