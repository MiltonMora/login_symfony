<?php


namespace App\Application\Users\Command;


class NewUserRolCommand
{
    private string $userEmail;

    private string $rolName;

    public function __construct(string $userEmail, string $rolName)
    {
        $this->userEmail = $userEmail;
        $this->rolName = $rolName;
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    public function getRolName(): string
    {
        return $this->rolName;
    }


    

}