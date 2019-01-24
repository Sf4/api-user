<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.01.19
 * Time: 18:50
 */

namespace Sf4\ApiUser\Response;

use Sf4\Api\Dto\DtoInterface;
use Sf4\Api\Response\AbstractResponse;
use Sf4\ApiUser\Dto\Response\DetailDto;
use Sf4\ApiUser\Entity\UserDetail;
use Sf4\ApiUser\Repository\UserDetailRepository;
use Sf4\Populator\Populator;

class DetailResponse extends AbstractResponse
{

    public function init()
    {
        $dto = new DetailDto();
        $dto->status = 'active';
        $dto->avatar = 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
        $data = $this->getData('96340873-2f61-44e7-9d79-c63ad0a699f0', UserDetail::class, $dto);
        $this->setResponseData($data);
    }

    /**
     * @param $id
     * @param string $entityClass
     * @param DtoInterface $dto
     * @return array|null
     */
    protected function getData($id, string $entityClass, DtoInterface $dto): ?array
    {
        /** @var UserDetailRepository $repository */
        $repository = $this->getRepository($entityClass);
        if($repository) {
            $data = $repository->getDetailData($id);
            if($data) {
                try {
                    $populator = new Populator();
                    /** @var DetailDto $dto */
                    $populator->populate($data, $dto);
                    $dto->roles = json_decode($dto->roles);
                    return $populator->unpopulate($dto);
                } catch (\ReflectionException $e) {
                    return null;
                }
            }
        }

        return null;
    }
}
