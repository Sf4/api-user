<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 25.01.19
 * Time: 7:59
 */

namespace Sf4\ApiUser\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Sf4\Api\Dto\Filter\FilterInterface;
use Sf4\Api\Repository\RepositoryInterface;
use Sf4\Api\Response\AbstractResponse;
use Sf4\Api\Utils\Traits\ArrayCollectionToArrayTrait;
use Sf4\ApiUser\CacheAdapter\CacheKeysInterface;
use Sf4\ApiUser\Dto\Filter\ListFilter;
use Sf4\ApiUser\Dto\Response\ListDto;
use Sf4\ApiUser\Repository\UserDetailRepository;

class ListResponse extends AbstractResponse
{

    use ArrayCollectionToArrayTrait;

    /**
     * @throws \Psr\Cache\CacheException
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function init()
    {
        $dto = new ListDto();
        $this->populateListDto($dto);
        $dto->setCurrentPage(1);
        $this->setResponseDto($dto);
    }

    /**
     * @param ListDto $dto
     * @throws \Psr\Cache\CacheException
     * @throws \Psr\Cache\InvalidArgumentException
     */
    protected function populateListDto(ListDto $dto)
    {
        $filter = null;
        $orders = null;
        /** @var \Sf4\ApiUser\Dto\Request\ListDto $requestDto */
        if ($requestDto = $this->getRequest()->getDto()) {
            /** @var ListFilter $filter */
            $filter = $requestDto->getFilter();
            $orders = $requestDto->getOrders();
            $dto->setOrders($orders);
        }

        /** @var UserDetailRepository $repository */
        $repository = $this->getRepository(UserDetailRepository::TABLE_NAME);
        $this->populateDto($dto, $this->getListData($repository, $filter, $orders));
        $dto->setCount($this->getListDataCount($repository, $filter, $orders));

        if ($filter) {
            $dto->setFilter($filter);
        }
    }

    /**
     * @param RepositoryInterface $repository
     * @param FilterInterface|null $filter
     * @param ArrayCollection|null $orders
     * @return array|mixed|null
     * @throws \Psr\Cache\CacheException
     * @throws \Psr\Cache\InvalidArgumentException
     */
    protected function getListData(
        RepositoryInterface $repository,
        FilterInterface $filter = null,
        ArrayCollection $orders = null
    ) {
        $hash = $this->getFilterAndOrdersHash($filter, $orders);
        $cacheKey = CacheKeysInterface::KEY_USER_LIST_DATA . $hash;
        return $this->getRequest()->getRequestHandler()->getCacheDataOrAdd(
            $cacheKey,
            function () use ($repository, $filter, $orders) {
                if ($repository instanceof UserDetailRepository) {
                    return $repository->getListData($filter, $orders);
                }
                return null;
            },
            [
                CacheKeysInterface::TAG_USER_LIST
            ]
        );
    }

    /**
     * @param RepositoryInterface $repository
     * @param FilterInterface|null $filter
     * @param ArrayCollection|null $orders
     * @return array|mixed|null
     * @throws \Psr\Cache\CacheException
     * @throws \Psr\Cache\InvalidArgumentException
     */
    protected function getListDataCount(
        RepositoryInterface $repository,
        FilterInterface $filter = null,
        ArrayCollection $orders = null
    ) {
        $hash = $this->getFilterAndOrdersHash($filter, $orders);
        $cacheKey = CacheKeysInterface::KEY_USER_LIST_DATA_COUNT . $hash;
        return $this->getRequest()->getRequestHandler()->getCacheDataOrAdd(
            $cacheKey,
            function () use ($repository, $filter, $orders) {
                if ($repository instanceof UserDetailRepository) {
                    return $repository->getListDataCount($filter, $orders);
                }
                return null;
            },
            [
                CacheKeysInterface::TAG_USER_LIST
            ]
        );
    }

    /**
     * @param FilterInterface|null $filter
     * @param ArrayCollection|null $orders
     * @return string
     */
    protected function getFilterAndOrdersHash(FilterInterface $filter = null, ArrayCollection $orders = null)
    {
        $filterArray = $filter->toArray();
        $ordersArray = $this->arrayCollectionToArray($orders);
        $filterJson = json_encode($filterArray);
        $ordersJson = json_encode($ordersArray);
        $json = $filterJson . $ordersJson;

        return md5($json);
    }
}
