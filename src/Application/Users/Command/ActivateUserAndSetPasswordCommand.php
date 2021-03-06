<?php


namespace App\Application\Users\Command;

use Symfony\Component\Validator\Constraints as Assert;

class ActivateUserAndSetPasswordCommand
{

    /**
     * @Assert\NotBlank()
     */
    private string $userId;

    /**
     * @Assert\NotBlank()
     */
    private string $password;

    public function __construct(
        string $userId,
        string $password
    ) {
        $this->userId = $userId;
        $this->password = $password;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}