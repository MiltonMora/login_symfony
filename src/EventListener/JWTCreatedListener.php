<?php

namespace App\EventListener;

use App\Domain\Users\Ports\RolInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use App\Repository\UserRolRepository;

class JWTCreatedListener
{
    private UserRolRepository $userRolRepository;
    private RolInterface $rol;

    public function __construct(
        UserRolRepository $userRolRepository,
        RolInterface $rol
    )
    {
        $this->userRolRepository = $userRolRepository;
        $this->rol = $rol;
    }


    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $user = $event->getUser();

        $payload       = $event->getData();
        $roles = $this->userRolRepository->getRolesByUserId($user->getId());
        $arrayRoles = array();

        foreach ($roles as $key => $value) {
            $rol = $this->rol->findByIdOrFail($value[1]);
            array_push($arrayRoles, $rol->getName());
        }

        $payload['roles'] = $arrayRoles;

        $event->setData($payload);
    }

}