<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 16.02.19
 * Time: 17:23
 */

namespace Sf4\ApiUser\Entity;

use Ramsey\Uuid\UuidInterface;

interface UserInterface
{
    public function getId(): ?int;

    public function getUuid(): UuidInterface;

    public function getStatus();

    public function setStatus($status);

    public function getEmail();

    public function setEmail($email);

    public function getRoles(): array;

    public function setRoles($roles);

    public function getUserDetail(): ?UserDetailInterface;

    public function getPassword(): ?string;

    public function getApiToken(): ?string;

    public function getGoogleId(): ?string;
}
