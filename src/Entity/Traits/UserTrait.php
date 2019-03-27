<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 25.01.19
 * Time: 9:12
 */

namespace Sf4\ApiUser\Entity\Traits;

use Sf4\Api\Entity\Traits\EntityIdTrait;
use Sf4\Api\Entity\Traits\StatusTrait;
use Sf4\ApiUser\Entity\Traits\User\PrivateTrait;
use Sf4\ApiUser\Entity\Traits\User\PublicTrait;
use Sf4\ApiUser\Entity\UserDetailInterface;

trait UserTrait
{
    use EntityIdTrait;
    use TimestampableTrait;
    use StatusTrait;
    use PublicTrait;
    use PrivateTrait;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $status;

    /**
     * @ORM\ManyToOne(targetEntity="Sf4\ApiUser\Entity\UserDetail", cascade={"persist"})
     */
    protected $userDetail;

    /**
     * A visual identifier that represents this user.
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @return UserDetailInterface|null
     */
    public function getUserDetail(): ?UserDetailInterface
    {
        return $this->userDetail;
    }

    /**
     * @param UserDetailInterface|null $userDetail
     */
    public function setUserDetail(?UserDetailInterface $userDetail): void
    {
        $this->userDetail = $userDetail;
    }
}
