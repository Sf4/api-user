<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 1.02.19
 * Time: 9:12
 */

namespace Sf4\ApiUser\Entity\Traits\User;

use Doctrine\ORM\Mapping as ORM;

trait PrivateTrait
{
    /**
     * @var string|null The hashed password
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @var string|null $api_token
     * @ORM\Column(type="string", unique=true)
     */
    protected $api_token;

    /**
     * @var string|null $google_id
     * @ORM\Column(type="string")
     */
    protected $google_id;

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getApiToken(): ?string
    {
        return $this->api_token;
    }

    /**
     * @param string|null $api_token
     */
    public function setApiToken(?string $api_token): void
    {
        $this->api_token = $api_token;
    }

    /**
     * @return string|null
     */
    public function getGoogleId(): ?string
    {
        return $this->google_id;
    }

    /**
     * @param string|null $google_id
     */
    public function setGoogleId(?string $google_id): void
    {
        $this->google_id = $google_id;
    }
}
