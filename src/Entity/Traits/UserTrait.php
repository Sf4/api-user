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
use Sf4\ApiUser\Entity\UserDetail;

trait UserTrait
{
    use EntityIdTrait;
    use TimestampableTrait;
    use StatusTrait;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="json")
     */
    protected $roles = [];

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
     * @ORM\ManyToOne(targetEntity="Sf4\ApiUser\Entity\UserDetail", cascade={"persist"})
     */
    protected $userDetail;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        // guarantee every user at least has ROLE_USER
        $this->roles[] = 'ROLE_USER';

        return array_unique($this->roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

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

    public function getUserDetail(): ?UserDetail
    {
        if ($this->userDetail === null) {
            $this->userDetail = new UserDetail();
            $this->userDetail->createNewToken();
        }

        return $this->userDetail;
    }

    public function setUserDetail(?UserDetail $userDetail): self
    {
        $this->userDetail = $userDetail;

        return $this;
    }
}
