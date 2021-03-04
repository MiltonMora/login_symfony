<?php


namespace App\Application\Business;


use App\Application\Business\Command\NewBusinessCommand;
use App\Domain\Business\Model\Business;
use App\Domain\Business\Ports\BusinessInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NewBusinessHandler
{
    /**
     * @param BusinessInterface
     */
    private BusinessInterface $businessPort;

    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    public function __construct(
        BusinessInterface $businessPort,
        ValidatorInterface $validator
    )
    {
        $this->businessPort = $businessPort;
        $this->validator = $validator;
    }

    public function handle(NewBusinessCommand $command)
    {
        $errors = $this->validator->validate($command);

        if (count($errors) > 0) {
            return $errorsString = (string) $errors;
        }

        try {
            $business = new Business(
                $command->getName(),
                $command->getEmail(),
                $command->getAddress(),
                $command->getIdn()
            );

            $this->businessPort->store($business);

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