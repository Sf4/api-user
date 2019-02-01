<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 1.02.19
 * Time: 9:12
 */

namespace Sf4\ApiUser\Entity\Traits\User;

trait PrivateTrait
{
    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $api_token;

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getApiToken(): ?string
    {
        return $this->api_token;
    }

    public function setApiToken(string $api_token): self
    {
        $this->api_token = $api_token;

        return $this;
    }
}
