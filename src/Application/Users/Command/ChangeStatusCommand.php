<?php


namespace App\Application\Users\Command;

use Symfony\Component\Validator\Constraints as Assert;

class ChangeStatusCommand
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}