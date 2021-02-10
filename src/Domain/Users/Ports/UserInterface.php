<?php


namespace App\Domain\Users\Ports;

use App\Domain\Users\Model\User;

interface UserInterface
{
    public function save(User $User);

    public function findOneByEmailOrFail(string $email);
}