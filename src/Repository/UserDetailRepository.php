<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 23.01.19
 * Time: 8:38
 */

namespace Sf4\ApiUser\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Sf4\Api\Dto\Filter\FilterQueryBuilder;
use Sf4\Api\Repository\AbstractRepository;
use Sf4\ApiUser\Dto\Filter\ListFilter;
use Sf4\ApiUser\Entity\User;

class UserDetailRepository extends AbstractRepository
{
    const TABLE_NAME = 'user_detail';

    /**
     * @param $userUuid
     * @return array|null
     */
    public function getDetailData($userUuid): ?array
    {
        if(empty($userUuid)) {
            return null;
        }

        $qb = $this->createUserQueryBuilder();
        $qb->where(
            $qb->expr()->andX(
                $qb->expr()->eq('u.uuid', ':uuid'),
                $qb->expr()->isNull('u.deleted_at')
            )
        );
        $qb->setParameter(':uuid', $userUuid);

        return $this->getSingleArrayResult($qb);
    }

    public function getListData(ListFilter $filter): ?array
    {
        $qb = $this->createUserQueryBuilder();
        $this->addFilterQuery($qb, $filter);
        return $qb->getQuery()->getArrayResult();
    }

    public function getListDataCount(ListFilter $filter)
    {
        $qb = $this->createUserQueryBuilder();
        $this->addFilterQuery($qb, $filter);
        $qb->select(
            $qb->expr()->count('u.id')
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

    public function addFilterQuery(QueryBuilder $queryBuilder, ListFilter $filter)
    {
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getId(), 'u.uuid');
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getEmail(), 'u.email');
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getStatus(), 'u.status');
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getRoles(), 'u.roles');
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getFirstName(), 'd.firstName');
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getLastName(), 'd.lastName');
        FilterQueryBuilder::buildQuery($queryBuilder, $filter->getAvatar(), 'd.avatar');
    }

    protected function createUserQueryBuilder(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('d');
        $qb->join(User::class, 'u', 'WITH', 'u.userDetail = d.id');
        $qb->select([
            'u.uuid AS id', 'u.email', 'u.roles', 'u.status',
            'd.firstName', 'd.lastName', 'd.avatar'
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
}
