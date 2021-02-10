<?php


namespace App\Application\Users;

use App\Domain\Users\Ports\RolInterface;
use App\Domain\Users\Model\Rol;
use App\Application\Users\Command\NewRolCommand;

class NewRolHandler
{
    /**
     * @var RolInterface
     */
    private $rolPort;

    public function __construct(RolInterface $rolPort)
    {
        $this->rolPort = $rolPort;
    }

    public function handle(NewRolCommand $command)
    {
        try {
            $rol = new  Rol($command->getName());
            $this->rolPort->store($rol);

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