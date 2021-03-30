<?php


namespace App\Application\Rol;


use App\Application\Rol\Command\GetRolesCommand;
use App\Domain\Users\Ports\RolInterface;

class GetRolesHandler
{
    private RolInterface $rolPort;

    public function __construct(RolInterface $rolPort)
    {
        $this->rolPort = $rolPort;
    }

    public function handle(GetRolesCommand $command)
    {
        $arrayRoles = [];
        $allData = $this->rolPort->getAll();
        foreach ($allData as $key => $value) {
            $arrayRoles[$key]['id'] = $value->getId();
            $arrayRoles[$key]['name'] = $value->getName();
        }
        return [
            "data" => $arrayRoles,
            "status" => 202
        ];
    }

}