<?php


namespace App\Application\Users;

use App\Entity\Rol;
use App\Repository\RolRepository;

class Role
{
    /**
     * @var RolRepository
     */
    private $rolRepository;


    public function __construct(RolRepository $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }

    public function handle(string $name)
    {
        $rol = new  Rol($name);
        $this->rolRepository->save($rol);
    }

}