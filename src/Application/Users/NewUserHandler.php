<?php


namespace App\Application\Users;

use App\Application\Users\Command\NewUserCommand;
use App\Domain\Users\Model\User;
use App\Domain\Users\Ports\RolInterface;
use App\Domain\Users\Ports\UserInterface;
use App\Domain\Users\Ports\UserRolInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Domain\Users\Model\UserRol;

class NewUserHandler
{
    private ValidatorInterface $validator;

    private UserInterface $user;

    private UserPasswordEncoderInterface $passwordEncoder;

    private UserRolInterface $userRolPort;

    private RolInterface $rolPort;

    public function __construct(
        UserInterface $user,
        ValidatorInterface $validator,
        UserPasswordEncoderInterface $passwordEncoder,
        UserRolInterface $userRolPort,
        RolInterface $rolPort
    ) {
        $this->user = $user;
        $this->validator = $validator;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRolPort = $userRolPort;
        $this->rolPort = $rolPort;
    }

    public function handle(NewUserCommand $command)
    {
        $errors = $this->validator->validate($command);

        if (count($errors) > 0) {
            return $errorsString = (string) $errors;
        }

        try {
            $user = new  User(
                $command->getName(),
                $command->getEmail(),
                $command->getPassword()
            );

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $command->getPassword()
            ));

            $this->user->save($user);

            $rol = $this->rolPort->findOneByNameOrFail($command->getRol());

            $userRol = new  UserRol($user, $rol);
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