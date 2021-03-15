<?php


namespace App\Domain\Users\Ports;

use App\Domain\Users\Model\UserRol;

interface UserRolInterface
{
    public function store(UserRol $userRol);

    public function getRolesByUserId(string $userId);

}