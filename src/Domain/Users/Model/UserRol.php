<?php


namespace App\Domain\Users\Model;


use Symfony\Component\Uid\Uuid;

class UserRol
{
    private string $id;
    private string $userId;
    private string $rolId;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    /**
     */
    public function __construct(string $userId, $rolId)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->userId = $userId;
        $this->rolId = $rolId;
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param string $rolId
     */
    public function setRolId(string $rolId): void
    {
        $this->rolId = $rolId;
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