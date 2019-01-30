<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 25.01.19
 * Time: 7:59
 */

namespace Sf4\ApiUser\Response;

use Sf4\Api\Response\AbstractResponse;
use Sf4\ApiUser\Dto\Filter\ListFilter;
use Sf4\ApiUser\Dto\Response\ListDto;
use Sf4\ApiUser\Entity\UserDetail;
use Sf4\ApiUser\Repository\UserDetailRepository;

class ListResponse extends AbstractResponse
{

    public function init()
    {
        $dto = new ListDto();
        $this->populateListDto($dto);
        $dto->setCurrentPage(1);
        $this->setResponseDto($dto);
    }

    /**
     * @param ListDto $dto
     */
    protected function populateListDto(ListDto $dto)
    {
        $filter = null;
        /** @var \Sf4\ApiUser\Dto\Request\ListDto $requestDto */
        if($requestDto = $this->getRequest()->getDto()) {
            /** @var ListFilter $filter */
            $filter = $requestDto->getFilter();
        }
        /** @var UserDetailRepository $repository */
        $repository = $this->getRepository(UserDetail::class);
        $this->populateDto($dto, $repository->getListData($filter));
        $dto->setCount($repository->getListDataCount($filter));

        if($filter) {
            $dto->setFilter($filter);
        }
    }
}
