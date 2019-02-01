<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 23.01.19
 * Time: 8:38
 */

namespace Sf4\ApiUser\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Sf4\Api\Dto\Filter\FilterQueryBuilder;
use Sf4\Api\Dto\Order\OrderInterface;
use Sf4\Api\Repository\AbstractRepository;
use Sf4\ApiUser\Dto\Filter\ListFilter;
use Sf4\ApiUser\Dto\Order\ListOrder;
use Sf4\ApiUser\Entity\User;

class UserDetailRepository extends AbstractRepository
{
    const TABLE_NAME = 'user_detail';

    const FIELD_ID = 'u.id';
    const FIELD_UUID = 'u.uuid';
    const FIELD_EMAIL = 'u.email';
    const FIELD_STATUS = 'u.status';
    const FIELD_ROLES = 'u.roles';
    const FIELD_DELETED = 'u.deleted_at';
    const FIELD_FIRST_NAME = 'd.firstName';
    const FIELD_LAST_NAME = 'd.lastName';
    const FIELD_AVATAR = 'd.avatar';

    /**
     * @param $userUuid
     * @return array|null
     */
    public function getDetailData($userUuid): ?array
    {
        if (empty($userUuid)) {
            return null;
        }

        $qb = $this->createUserQueryBuilder();
        $qb->where(
            $qb->expr()->andX(
                $qb->expr()->eq(static::FIELD_UUID, ':uuid'),
                $qb->expr()->isNull(static::FIELD_DELETED)
            )
        );
        $qb->setParameter(':uuid', $userUuid);

        return $this->getSingleArrayResult($qb);
    }

    protected function createUserQueryBuilder(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('d');
        $qb->join(User::class, 'u', 'WITH', 'u.userDetail = d.id');
        $qb->select([
            static::FIELD_UUID . ' AS id', static::FIELD_EMAIL, static::FIELD_ROLES, static::FIELD_STATUS,
            static::FIELD_FIRST_NAME, static::FIELD_LAST_NAME, static::FIELD_AVATAR
        ]);

        return $qb;
    }

    protected function getSingleArrayResult(QueryBuilder $qb): ?array
    {
        $response = null;
        try {
            $response = $qb->getQuery()->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (NoResultException $e) {
            $response = null;
        } catch (NonUniqueResultException $e) {
            $response = null;
        }

        return $response;
    }

    public function getListData(ListFilter $filter = null, ArrayCollection $orders = null): ?array
    {
        $qb = $this->createUserQueryBuilder();
        $this->addFilterQuery($qb, $filter);
        $this->addOrdersQuery($qb, $orders);
        return $qb->getQuery()->getArrayResult();
    }

    public function addFilterQuery(QueryBuilder $queryBuilder, ListFilter $filter = null)
    {
        if (!$filter) {
            return;
        }
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getId(), static::FIELD_UUID);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getEmail(), static::FIELD_EMAIL);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getStatus(), static::FIELD_STATUS);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getRoles(), static::FIELD_ROLES);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getFirstName(), static::FIELD_FIRST_NAME);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getLastName(), static::FIELD_LAST_NAME);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getAvatar(), static::FIELD_AVATAR);
    }

    public function addOrdersQuery(QueryBuilder $queryBuilder, ArrayCollection $oders = null)
    {
        if (!$oders) {
            return;
        }
        /** @var OrderInterface $oder */
        foreach ($oders as $oder) {
            $this->addOrderQuery($queryBuilder, $oder);
        }
    }

    public function addOrderQuery(QueryBuilder $queryBuilder, OrderInterface $order)
    {
        switch ($order->getField()) {
            case ListOrder::FIELD_ID:
                $sort = static::FIELD_ID;
                break;
            case ListOrder::FIELD_EMAIL:
                $sort = static::FIELD_EMAIL;
                break;
            case ListOrder::FIELD_FIRST_NAME:
                $sort = static::FIELD_FIRST_NAME;
                break;
            case ListOrder::FIELD_LAST_NAME:
                $sort = static::FIELD_LAST_NAME;
                break;
            case ListOrder::FIELD_STATUS:
                $sort = static::FIELD_STATUS;
                break;
            default:
                $sort = static::FIELD_ID;
        }
        $queryBuilder->addOrderBy($sort, $order->getDirection());
    }

    public function getListDataCount(ListFilter $filter = null, ArrayCollection $orders = null)
    {
        $qb = $this->createUserQueryBuilder();
        $this->addFilterQuery($qb, $filter);
        $this->addOrdersQuery($qb, $orders);
        $qb->select(
            $qb->expr()->count(static::FIELD_ID)
        );

        try {
            $response = $qb->getQuery()->getSingleResult(Query::HYDRATE_SINGLE_SCALAR);
        } catch (NoResultException $e) {
            $response = 0;
        } catch (NonUniqueResultException $e) {
            $response = 0;
        }
        return $response;
    }
}
