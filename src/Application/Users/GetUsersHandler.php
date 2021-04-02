<?php


namespace App\Application\Users;

use App\Application\Users\Command\GetUsersCommand;
use App\Domain\Business\Ports\BusinessInterface;
use App\Domain\Business\Ports\BusinessUserInterface;
use App\Domain\Users\Ports\RolInterface;
use App\Domain\Users\Ports\UserInterface;
use App\Domain\Users\Ports\UserRolInterface;

class GetUsersHandler
{
    private UserInterface $user;
    private UserRolInterface $userRolPort;
    private RolInterface $rolPort;
    private BusinessInterface $businessPort;
    private BusinessUserInterface $businessUserPort;


    public function __construct(
        UserInterface $user,
        UserRolInterface $userRolPort,
        RolInterface $rolPort,
        BusinessInterface $businessPort,
        BusinessUserInterface $businessUserPort
    ) {
        $this->user = $user;
        $this->userRolPort = $userRolPort;
        $this->rolPort = $rolPort;
        $this->businessPort = $businessPort;
        $this->businessUserPort = $businessUserPort;
    }

    public function handle(GetUsersCommand $command)
    {
        try {
            $dt = array();
            if($command->getId() != null) {
                $data = $this->user->findById($command->getId());
                $rol = $this->getRol($data->getId());
                $pBusiness = 'all';
                if(!in_array('SuperAdministrator', $rol)) {
                    $pBusiness = $this->getBusiness($data->getId());
                }
                $dt = [
                        "name" => $data->getName(),
                        "email" => $data->getEmail(),
                        "status" => $data->isStatus(),
                        "created" => $data->getCreatedAt(),
                        "rol" => $rol,
                        "business" => $pBusiness
                ];
            }
            else{
                $data = $this->user->all();
                foreach ($data as $value) {
                    $pBusiness = 'all';
                    $rol = $this->getRol($value->getId());
                    if(!in_array('SuperAdministrator', $rol)) {
                        $pBusiness = $this->getBusiness($value->getId());
                    }
                   array_push ($dt, [
                       "id" => $value->getId(),
                       "name" => $value->getName(),
                       "email" => $value->getEmail(),
                       "status" => $value->isStatus(),
                       "created" => $value->getCreatedAt(),
                       "rol" => $rol,
                       "business" => $pBusiness
                       ]);
                }
            }
            return [
                "data" => $dt,
                "status" => 202
            ];

        } catch (\Exception $e) {
            return [
                "data" => $e->getMessage(),
                "status" => 404
            ];
        }
    }

    private function getRol(string $userId)
    {
        $rol = $this->userRolPort->getRolesByUserId($userId);
        $arrayRoles = array();
        foreach ($rol as $key =>
                 $value) {
            $roles = $this->rolPort->findByIdOrFail($value[1]);
            array_push($arrayRoles, $roles->getName());
        }
        return $arrayRoles;
    }

    private function getBusiness(string $userId)
    {
        $business = $this->businessUserPort->findOrFailByUserId($userId);
        $arrayBusiness = array();
        foreach ($business as $values) {
            $data = ["id" => $values->getBusiness()->getId(),
                "name" => $values->getBusiness()->getName()];
            array_push($arrayBusiness, $data);
        }
        return $arrayBusiness;
    }

}