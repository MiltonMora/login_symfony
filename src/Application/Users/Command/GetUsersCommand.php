<?php


namespace App\Application\Users\Command;

class GetUsersCommand
{
    private ?string $id;

    public function __construct(?string $id)
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }


}