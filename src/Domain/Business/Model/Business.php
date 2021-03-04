<?php


namespace App\Domain\Business\Model;

use Symfony\Component\Uid\Uuid;

class Business
{
    private string $id;
    private string $name;
    private string $email;
    private string $address;
    private string $idn;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    /**
     */
    public function __construct(
        string $name,
        string $email,
        string $address,
        string $in
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->setEmail($email);
        $this->address = $address;
        $this->idn = $in;
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        if (!\filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            throw new \LogicException('Invalid email');
        }
        $this->email = $email;
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

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getIdn(): string
    {
        return $this->idn;
    }

    /**
     * @param string $idn
     */
    public function setIdn(string $idn): void
    {
        $this->idn = $idn;
    }

}