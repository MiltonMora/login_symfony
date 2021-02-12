<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use App\Repository\UserRolRepository;

class JWTCreatedListener
{
    private UserRolRepository $userRolRepository;

    public function __construct(UserRolRepository $userRolRepository)
    {
        $this->userRolRepository = $userRolRepository;
    }


    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $user = $event->getUser();

        $payload       = $event->getData();
        $payload['roles'] = [
            $this->userRolRepository->getRolesByUserId($user->getId())
        ];

        $event->setData($payload);
    }

}