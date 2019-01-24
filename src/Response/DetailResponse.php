<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.01.19
 * Time: 18:50
 */

namespace Sf4\ApiUser\Response;

use Sf4\Api\Response\AbstractResponse;
use Sf4\ApiUser\Dto\Response\DetailDto;
use Sf4\ApiUser\Entity\UserDetail;
use Sf4\ApiUser\Repository\UserDetailRepository;

class DetailResponse extends AbstractResponse
{

    public function init()
    {
        $dto = new DetailDto();
        $userId = $this->getIdFromRequest();
        $this->populateDetailDto($dto,$userId);
        $dto->status = $dto->getStatusCode();
        $dto->avatar = $dto->getAvatarOrDefault();
        $dto->roles = $dto->getRolesArray();
        $this->setResponseDto($dto);
    }

    protected function getIdFromRequest()
    {
        $request = $this->getRequest()->getRequest();

        return $request->get('id');
    }

    /**
     * @param DetailDto $dto
     * @param $userUuid
     */
    protected function populateDetailDto(DetailDto $dto, $userUuid)
    {
        /** @var UserDetailRepository $repository */
        $repository = $this->getRepository(UserDetail::class);
        if($repository) {
            $data = $repository->getDetailData($userUuid);
            if($data) {
                $this->populateDto($dto, $data);
            }
        }
    }
}
