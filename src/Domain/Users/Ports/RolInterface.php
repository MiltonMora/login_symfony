<?php


namespace App\Domain\Users\Ports;

use App\Domain\Users\Model\Rol;

interface RolInterface
{
    public function store(Rol $rol);
}