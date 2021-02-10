<?php


namespace App\Application\Users;

use App\Application\Users\Command\NewUserCommand;
use App\Domain\Users\Model\User;
use App\Domain\Users\Ports\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class NewUserHandler
{
    private ValidatorInterface $validator;

    private UserInterface $user;

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(
        UserInterface $user,
        ValidatorInterface $validator,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->user = $user;
        $this->validator = $validator;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function handle(NewUserCommand $command)
    {
        $errors = $this->validator->validate($command);

        if (count($errors) > 0) {
            return $errorsString = (string) $errors;;
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