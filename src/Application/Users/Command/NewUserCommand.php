<?php


namespace App\Application\Users\Command;

use Symfony\Component\Validator\Constraints as Assert;

class NewUserCommand
{

    /**
     * @Assert\NotBlank()
     */
    private string $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private string $email;

    private string $password;

    /**
     * @Assert\NotBlank()
     */
    private string $rol;

    /**
     * @Assert\NotBlank()
     */
    private string $businessId;

    public function __construct(
        string $name,
        string $email,
        string $password,
        string $rol,
        string $businessId
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
        $this->businessId = $businessId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRol(): string
    {
        return $this->rol;
    }

    public function getBusinessId(): string
    {
        return $this->businessId;
    }


}