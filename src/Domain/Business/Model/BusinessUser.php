<?php


namespace App\Domain\Business\Model;

use App\Domain\Users\Model\User;
use Symfony\Component\Uid\Uuid;

class BusinessUser
{
    private string $id;
    private Business $business;
    private User $user;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(
        Business $business,
        User $user
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->business = $business;
        $this->user = $user;
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function getBusiness(): Business
    {
        return $this->business;
    }

    public function setBusiness(Business $business): void
    {
        $this->business = $business;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }


    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new  \DateTime();
    }

}