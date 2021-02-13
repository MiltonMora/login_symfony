<?php


namespace App\Domain\Users\Model;


use Symfony\Component\Uid\Uuid;

class UserRol
{
    private string $id;
    private User $user;
    private Rol $rol;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    /**
     */
    public function __construct(User $userId, Rol $rolId)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->user = $userId;
        $this->rol = $rolId;
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
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * @param string $rol
     */
    public function setRol(string $rol): void
    {
        $this->rol = $rol;
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