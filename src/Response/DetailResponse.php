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
        $data = $this->getData('3f2c07bc-eb3c-4fc8-95df-b2db7559cd41', UserDetail::class, $dto);
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
                    $object = $populator->populate($data, $dto);
                    return $populator->unpopulate($object);
                } catch (\ReflectionException $e) {
                    return null;
                }
            }
        }

        return null;
    }
}
