<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 21.01.19
 * Time: 10:04
 */

namespace Sf4\ApiUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sf4\Api\Entity\EntityInterface;
use Sf4\Api\Entity\Traits\EntityIdTrait;
use Sf4\Api\Entity\Traits\StatusTrait;
use Sf4\Api\Entity\Traits\TimestampableTrait;

/**
 * @ORM\Entity(repositoryClass="Sf4\ApiUser\Repository\UserRepository")
 * @ORM\Table(indexes={
 *     @ORM\Index(name="email_idx", columns={"email"})
 * })
 */
class User implements EntityInterface
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
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
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
     * @see UserInterface
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

    /**
     * @see UserInterface
     */
    public function getSalt()
    {

    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {

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
