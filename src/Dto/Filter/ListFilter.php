<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 27.01.19
 * Time: 17:01
 */

namespace Sf4\ApiUser\Dto\Filter;

use Sf4\Api\Dto\Filter\AbstractFilter;
use Sf4\ApiUser\Dto\Traits\DetailBaseTrait;

class ListFilter extends AbstractFilter
{
    use DetailBaseTrait;

    public function getRoles()
    {
        return $this->roles;
    }

    public function toArray(): array
    {
        $data = [
            'id' => $this->getId(),
            'roles' => $this->getRoles(),
            'status' => $this->getStatus(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' => $this->getEmail()
        ];
        return $this->filterDataToArray($data);
    }
}
