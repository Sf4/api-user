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

    public abstract function toArray(): array;

    /**
     * @return array
     */
    public function detailToArray(array $data): array
    {
        $data['status_code'] = $this->getStatusCode();
        $data['default_avatar'] = $this->getAvatarOrDefault();
        if(false === is_array($data['roles'])) {
            $data['roles'] = $this->getRolesArray();
        }
        return $data;
    }

    public function getStatusCode()
    {
        return $this->getStatus() == StatusSettingInterface::ACTIVE ? DetailDtoInterface::STATUS_CODE_ACTIVE : DetailDtoInterface::STATUS_CODE_INACTIVE;
    }

    public function getAvatarOrDefault()
    {
        if(empty($this->getAvatar())) {
            return 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
        }

        return $this->getAvatar();
    }

    public function getRolesArray(): ?array
    {
        if($this->getRoles() && false === is_array($this->getRoles())) {
            return json_decode($this->getRoles());
        }

        return null;
    }
}
