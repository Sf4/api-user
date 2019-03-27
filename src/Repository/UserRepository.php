<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 23.01.19
 * Time: 8:29
 */

namespace Sf4\ApiUser\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Sf4\Api\Repository\AbstractRepository;
use Sf4\ApiUser\Entity\User;
use Sf4\ApiUser\Entity\UserInterface;

class UserRepository extends AbstractRepository
{
    public const TABLE_NAME = 'user';

    /**
     * @return string
     */
    protected function getEntityClass(): string
    {
        return User::class;
    }

    /**
     * @param string $role
     * @return UserInterface|null
     */
    public function getUserByRole(string $role): ?UserInterface
    {
        $likeRole = '%'.$role.'%';
        $queryBuilder = $this->createQueryBuilder('main');
        $queryBuilder->where(
            $queryBuilder->expr()->like(
                'main.roles',
                ':role'
            )
        );
        $queryBuilder->setParameter(':role', $likeRole);
        $queryBuilder->setMaxResults(1);

        return $this->getOneOrNullUser($queryBuilder);
    }

    /**
     * @param string $token
     * @return UserInterface|null
     */
    public function getUserByToken(string $token): ?UserInterface
    {
        $queryBuilder = $this->createQueryBuilder('main');

        $queryBuilder->where(
            $queryBuilder->expr()->eq('main.api_token', ':token')
        );
        $queryBuilder->setParameter(':token', $token);

        $queryBuilder->andWhere(
            $queryBuilder->expr()->isNull('main.deleted_at')
        );

        return $this->getOneOrNullUser($queryBuilder);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @return UserInterface|null
     */
    protected function getOneOrNullUser(QueryBuilder $queryBuilder): ?UserInterface
    {
        try {
            return $queryBuilder->getQuery()->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
