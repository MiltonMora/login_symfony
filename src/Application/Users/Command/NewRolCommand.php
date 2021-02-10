<?php


namespace App\Application\Users\Command;


class NewRolCommand
{
    private string $name;
    
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
    

}