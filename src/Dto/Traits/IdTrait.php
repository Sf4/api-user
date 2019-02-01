<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 1.02.19
 * Time: 9:18
 */

namespace Sf4\ApiUser\Dto\Traits;

trait IdTrait
{
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}
