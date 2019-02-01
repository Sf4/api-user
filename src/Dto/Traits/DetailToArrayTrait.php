<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 29.01.19
 * Time: 8:40
 */

namespace Sf4\ApiUser\Dto\Traits;

use Sf4\Api\Setting\StatusSettingInterface;
use Sf4\ApiUser\Dto\Response\DetailDtoInterface;

trait DetailToArrayTrait
{

    abstract public function toArray(): array;

    /**
     * @param array $data
     * @return array
     */
    public function detailToArray(array $data): array
    {
        $data['status_code'] = $this->getStatusCode();
        if (empty($data['avatar'])) {
            $data['default_avatar'] = $this->getAvatarOrDefault();
        }
        if (false === is_array($data['roles'])) {
            $data['roles'] = $this->getRolesArray();
        }
        return $data;
    }

    public function getStatusCode()
    {
        $active = DetailDtoInterface::STATUS_CODE_ACTIVE;
        $inactive = DetailDtoInterface::STATUS_CODE_INACTIVE;
        return $this->getStatus() == StatusSettingInterface::ACTIVE ? $active : $inactive;
    }

    public function getAvatarOrDefault()
    {
        if (empty($this->getAvatar())) {
            return 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
        }

        return $this->getAvatar();
    }

    public function getRolesArray(): ?array
    {
        if ($this->getRoles() && false === is_array($this->getRoles())) {
            return json_decode($this->getRoles());
        }

        return null;
    }
}
