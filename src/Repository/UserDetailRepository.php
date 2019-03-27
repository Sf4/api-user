<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 23.01.19
 * Time: 8:38
 */

namespace Sf4\ApiUser\Repository;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Sf4\Api\Dto\Filter\FilterQueryBuilder;
use Sf4\Api\Dto\Order\OrderInterface;
use Sf4\Api\Repository\AbstractRepository;
use Sf4\Api\Repository\Traits\ListTrait;
use Sf4\ApiUser\Dto\Filter\ListFilter;
use Sf4\ApiUser\Entity\User;
use Sf4\ApiUser\Entity\UserDetail;
use Sf4\ApiUser\Entity\UserDetailFieldInterface;
use Sf4\ApiUser\Entity\UserFieldsInterface;

class UserDetailRepository extends AbstractRepository implements UserFieldsInterface, UserDetailFieldInterface
{
    use ListTrait;

    public const TABLE_NAME = 'user_detail';
    public const ALIAS_MAIN = 'main';
    public const ALIAS_DETAIL = 'd';
    public const PREFIX_MAIN = self::ALIAS_MAIN . '.';
    public const PREFIX_DETAIL = self::ALIAS_DETAIL . '.';

    public const DB_FIELD_ID = self::PREFIX_MAIN . self::FIELD_ID;
    public const DB_DETAIL_ID = self::PREFIX_DETAIL . self::FIELD_ID;
    public const DB_FIELD_UUID = self::PREFIX_MAIN . self::FIELD_UUID;
    public const DB_FIELD_EMAIL = self::PREFIX_MAIN . self::FIELD_EMAIL;
    public const DB_FIELD_ROLES = self::PREFIX_MAIN . self::FIELD_ROLES;
    public const DB_FIELD_STATUS = self::PREFIX_MAIN . self::FIELD_STATUS;
    public const DB_FIELD_DELETED_AT = self::PREFIX_MAIN . self::FIELD_DELETED_AT;
    public const DB_FIELD_AVATAR = self::PREFIX_DETAIL . self::FIELD_AVATAR;
    public const DB_FIELD_LAST_NAME = self::PREFIX_DETAIL . self::FIELD_LAST_NAME;
    public const DB_FIELD_FIRST_NAME = self::PREFIX_DETAIL . self::FIELD_FIRST_NAME;
    public const DB_FIELD_USER_DETAIL = self::PREFIX_MAIN . self::FIELD_USER_DETAIL;

    protected function getEntityClass(): string
    {
        return UserDetail::class;
    }

    protected function getUserEntityClass(): string
    {
        return User::class;
    }

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
                $qb->expr()->eq(static::DB_FIELD_UUID, ':' . static::FIELD_UUID),
                $qb->expr()->isNull(static::DB_FIELD_DELETED_AT)
            )
        );
        $qb->setParameter(':' . static::FIELD_UUID, $userUuid);

        return $this->getSingleArrayResult($qb);
    }

    protected function createUserQueryBuilder(): QueryBuilder
    {
        $qb = $this->createQueryBuilder(static::ALIAS_DETAIL);
        $qb->join(
            $this->getUserEntityClass(),
            static::ALIAS_MAIN,
            Join::WITH,
            static::DB_FIELD_USER_DETAIL . '=' . static::DB_DETAIL_ID
        );
        $qb->select([
            static::DB_FIELD_UUID . ' as ' . static::FIELD_ID,
            static::DB_FIELD_EMAIL,
            static::DB_FIELD_ROLES,
            static::DB_FIELD_STATUS,
            static::DB_FIELD_FIRST_NAME,
            static::DB_FIELD_LAST_NAME,
            static::DB_FIELD_AVATAR
        ]);

        return $qb;
    }

    protected function addFilterQuery(QueryBuilder $queryBuilder, ListFilter $filter = null)
    {
        if (!$filter) {
            return;
        }
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getId(), static::DB_FIELD_UUID);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getEmail(), static::DB_FIELD_EMAIL);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getStatus(), static::DB_FIELD_STATUS);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getRoles(), static::DB_FIELD_ROLES);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getFirstName(), static::DB_FIELD_FIRST_NAME);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getLastName(), static::DB_FIELD_LAST_NAME);
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getAvatar(), static::DB_FIELD_AVATAR);
    }

    protected function addOrderQuery(QueryBuilder $queryBuilder, OrderInterface $order)
    {
        switch ($order->getField()) {
            case static::FIELD_ID:
                $sort = static::DB_FIELD_ID;
                break;
            case static::FIELD_EMAIL:
                $sort = static::DB_FIELD_EMAIL;
                break;
            case static::FIELD_FIRST_NAME:
                $sort = static::DB_FIELD_FIRST_NAME;
                break;
            case static::FIELD_LAST_NAME:
                $sort = static::DB_FIELD_LAST_NAME;
                break;
            case static::FIELD_STATUS:
                $sort = static::DB_FIELD_STATUS;
                break;
            default:
                $sort = static::DB_FIELD_ID;
        }
        $queryBuilder->addOrderBy($sort, $order->getDirection());
    }

    protected function createListQueryBuilder(): QueryBuilder
    {
        return $this->createUserQueryBuilder();
    }
}
