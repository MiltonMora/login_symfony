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

    /**
     * @Assert\NotBlank()
     */
    private string $password;

    /**
     * @Assert\NotBlank()
     */
    private string $rol;

    public function __construct(
        string $name,
        string $email,
        string $password,
        string $rol
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
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


}