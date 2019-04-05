<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 25.02.19
 * Time: 9:06
 */

namespace Sf4\ApiUser\Entity;

use DateTimeInterface;

interface TimestampableInterface
{
    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $created_at
     */
    public function setCreatedAt(?DateTimeInterface $created_at);

    /**
     * @return UserInterface|null
     */
    public function getCreatedBy(): ?UserInterface;

    /**
     * @param UserInterface|null $created_by
     */
    public function setCreatedBy(?UserInterface $created_by);

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $updated_at
     */
    public function setUpdatedAt(?DateTimeInterface $updated_at);

    /**
     * @return UserInterface|null
     */
    public function getUpdatedBy(): ?UserInterface;

    /**
     * @param UserInterface|null $updated_by
     */
    public function setUpdatedBy(?UserInterface $updated_by);

    /**
     * @return DateTimeInterface|null
     */
    public function getDeletedAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $deleted_at
     */
    public function setDeletedAt(?DateTimeInterface $deleted_at);

    /**
     * @return UserInterface|null
     */
    public function getDeletedBy(): ?UserInterface;

    /**
     * @param UserInterface|null $deleted_by
     */
    public function setDeletedBy(?UserInterface $deleted_by);
}
