<?php

namespace App\EventListener;

use App\Domain\Users\Ports\RolInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use App\Repository\UserRolRepository;
use App\Repository\UserRepository;
use App\Repository\Business\BusinessUserRepository;

class JWTCreatedListener
{
    private UserRolRepository $userRolRepository;
    private RolInterface $rol;
    private UserRepository $user;
    private BusinessUserRepository $businessUser;

    public function __construct(
        UserRolRepository $userRolRepository,
        RolInterface $rol,
        UserRepository $user,
        BusinessUserRepository $businessUser
    )
    {
        $this->userRolRepository = $userRolRepository;
        $this->rol = $rol;
        $this->user = $user;
        $this->businessUser = $businessUser;
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

        $dataUser = $this->user->findById($user->getId());

        $payload['status'] = $dataUser->isStatus();

        $payload['roles'] = $arrayRoles;

        $event->setData($payload);
    }

}