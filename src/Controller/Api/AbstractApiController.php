<?php


namespace App\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use League\Tactician\CommandBus;
use \Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AbstractApiController extends AbstractController
{
    /**
     * @var CommandBus
     */
    protected $commandBus;

    const SUPERADMIN = 'SuperAdministrator';
    const ADMIN = 'Adminstrator';

    public function __construct(
        CommandBus $commandBus
    )
    {
        $this->commandBus = $commandBus;
    }

    public function checkPermissions(
        $userData,
        $requiredPermits
    )
    {
        $data = explode('.', explode(" ", $userData)[1]);
        $data = json_decode(base64_decode($data[1]));
        return in_array($requiredPermits, $data->roles);

    }

}