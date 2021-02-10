<?php


namespace App\Application\Users;

use App\Domain\Users\Ports\RolInterface;
use App\Domain\Users\Ports\UserInterface;
use App\Domain\Users\Ports\UserRolInterface;
use App\Domain\Users\Model\UserRol;
use App\Application\Users\Command\NewUserRolCommand;

class NewUserRolHandler
{

    private UserInterface $userPort;

    private RolInterface $rolPort;

    private UserRolInterface $userRolPort;

    public function __construct(
        UserInterface $userPort,
        RolInterface $rolPort,
        UserRolInterface $userRolPort
    )
    {
        $this->userRolPort = $userRolPort;
        $this->userPort = $userPort;
        $this->rolPort = $rolPort;
    }

    public function handle(NewUserRolCommand $command)
    {
        try {
            $userEmail = $this->userPort->findOneByEmailOrFail($command->getUserEmail());
            $rolName = $this->rolPort->findOneByNameOrFail($command->getRolName());

            $userRol = new  UserRol($userEmail->getId(), $rolName->getId());
            $this->userRolPort->store($userRol);

            return [
                "status" => 202
            ];
        } catch (\Exception $e) {
            return [
                "data" => $e->getMessage(),
                "status" => 404
            ];
        }
    }

}