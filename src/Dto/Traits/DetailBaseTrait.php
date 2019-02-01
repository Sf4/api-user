<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 29.01.19
 * Time: 8:47
 */

namespace Sf4\ApiUser\Dto\Traits;

use Sf4\Api\Entity\Traits\StatusTrait;
use Sf4\ApiUser\Entity\Traits\User\PublicTrait as UserPublicTrait;
use Sf4\ApiUser\Entity\Traits\UserDetail\PublicTrait as UserDetailPublicTrait;

trait DetailBaseTrait
{
    use IdTrait;
    use UserPublicTrait;
    use UserDetailPublicTrait;
    use StatusTrait;
}
