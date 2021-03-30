<?php


namespace App\Domain\Users\Ports;

use App\Domain\Users\Model\Rol;

interface RolInterface
{
    public function store(Rol $rol);

    public function findOneByNameOrFail(string $name): ?Rol;

    public function findByIdOrFail(string $id): ?Rol;

    public function getAll(): array;
}