<?php


namespace App\Application\Business;


use App\Application\Business\Command\NewBusinessUserCommand;
use App\Domain\Business\Model\BusinessUser;
use App\Domain\Business\Ports\BusinessInterface;
use App\Domain\Users\Ports\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Domain\Business\Ports\BusinessUserInterface;

class NewBusinessUserHandler
{
    private BusinessInterface $businessPort;

    private ValidatorInterface $validator;

    private UserInterface $userPort;

    private BusinessUserInterface $businessUserPort;


    public function __construct(
        BusinessInterface $businessPort,
        ValidatorInterface $validator,
        UserInterface $userPort,
        BusinessUserInterface $businessUserPort
    ) {
        $this->businessPort = $businessPort;
        $this->validator = $validator;
        $this->userPort = $userPort;
        $this->businessUserPort = $businessUserPort;
    }

    public function handle(NewBusinessUserCommand $command)
    {
        $errors = $this->validator->validate($command);

        if (count($errors) > 0) {
            return $errorsString = (string) $errors;
        }

        try {
            $this->businessUserPort->store(
               new BusinessUser(
                    $this->businessPort->getBusinessById($command->getBusinessId()),
                    $this->userPort->findById($command->getUserId())
                )
            );
            return [
                "status" => 202
            ];
        }
        catch (\Exception $e) {
            return [
                "data" => $e->getMessage(),
                "status" => 404
            ];
        }
    }
}