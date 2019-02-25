<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 24.01.19
 * Time: 18:45
 */

namespace Sf4\ApiUser\Entity\Traits;

use Sf4\ApiUser\Entity\UserInterface;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableTrait
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $created_by;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $updated_by;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deleted_at;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $deleted_by;

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param \DateTimeInterface|null $created_at
     */
    public function setCreatedAt(?\DateTimeInterface $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return UserInterface|null
     */
    public function getCreatedBy(): ?UserInterface
    {
        return $this->created_by;
    }

    /**
     * @param UserInterface|null $created_by
     */
    public function setCreatedBy(?UserInterface $created_by)
    {
        $this->created_by = $created_by;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTimeInterface|null $updated_at
     */
    public function setUpdatedAt(?\DateTimeInterface $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return UserInterface|null
     */
    public function getUpdatedBy(): ?UserInterface
    {
        return $this->updated_by;
    }

    /**
     * @param UserInterface|null $updated_by
     */
    public function setUpdatedBy(?UserInterface $updated_by)
    {
        $this->updated_by = $updated_by;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deleted_at;
    }

    /**
     * @param \DateTimeInterface|null $deleted_at
     */
    public function setDeletedAt(?\DateTimeInterface $deleted_at)
    {
        $this->deleted_at = $deleted_at;
    }

    /**
     * @return UserInterface|null
     */
    public function getDeletedBy(): ?UserInterface
    {
        return $this->deleted_by;
    }

    /**
     * @param UserInterface|null $deleted_by
     */
    public function setDeletedBy(?UserInterface $deleted_by)
    {
        $this->deleted_by = $deleted_by;
    }
}
