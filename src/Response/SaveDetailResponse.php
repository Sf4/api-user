<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 4.02.19
 * Time: 10:09
 */

namespace Sf4\ApiUser\Response;

use Sf4\Api\Dto\Response\BaseSaveDto;
use Sf4\Api\Response\AbstractSaveResponse;
use Sf4\ApiUser\Entity\User;
use Sf4\ApiUser\EntitySaver\DetailEntitySaver;
use Sf4\ApiUser\Repository\UserRepository;

class SaveDetailResponse extends AbstractSaveResponse
{
    public const MESSAGE_CODE_PREFIX = 'user.detail.';

    protected function getSaveDtoClass(): string
    {
        return BaseSaveDto::class;
    }

    protected function getEntityClass(): string
    {
        $request = $this->getRequest();
        if ($request) {
            $requestHandler = $request->getRequestHandler();
            if ($requestHandler) {
                $entityClass = $requestHandler->getRepositoryFactory()->getEntityClass(
                    UserRepository::TABLE_NAME
                );
                if ($entityClass) {
                    return $entityClass;
                }
            }
        }

        return User::class;
    }

    protected function getEntitySaverClass(): string
    {
        return DetailEntitySaver::class;
    }

    protected function getMessageCodePrefix(): string
    {
        return static::MESSAGE_CODE_PREFIX;
    }
}
