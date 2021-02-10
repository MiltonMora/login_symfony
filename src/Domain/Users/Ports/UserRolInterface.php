<?php


namespace App\Domain\Users\Ports;

use App\Domain\Users\Model\UserRol;

interface UserRolInterface
{
    public function store(UserRol $userRol);

}