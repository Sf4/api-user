<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 23.01.19
 * Time: 8:38
 */

namespace Sf4\ApiUser\Repository;

use Sf4\Api\Repository\AbstractRepository;

class UserDetailRepository extends AbstractRepository
{
    const TABLE_NAME = 'user_detail';

    /**
     * @param $userUuid
     * @return array|null
     */
    public function getDetailData($userUuid): ?array
    {
        $sql = 'SELECT u.uuid AS id, u.email, u.roles, d.first_name AS firstName, d.last_name AS lastName ';
        $sql .= 'FROM ' . UserRepository::TABLE_NAME . ' AS u ';
        $sql .= 'JOIN ' . static::TABLE_NAME . ' AS d ON d.id = u.user_detail_id ';
        $sql .= 'WHERE u.uuid = ? AND u.deleted_at IS NULL';
        $params = [$userUuid];

        return $this->findOneOrNullData($sql, $params);
    }
}
