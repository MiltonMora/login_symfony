<?php


namespace App\Application\Users;

use App\Domain\Users\Ports\RolInterface;
use App\Domain\Users\Model\Rol;
use App\Application\Users\Command\RolCommand;

class RolHandler
{
    /**
     * @var RolInterface
     */
    private $rolPort;

    public function __construct(RolInterface $rolPort)
    {
        $this->rolPort = $rolPort;
    }

    public function handle(RolCommand $command)
    {
        $rol = new  Rol($command->getName());
        $this->rolPort->store($rol);
    }

}