<?php


namespace App\Application\Business\Command;

use Symfony\Component\Validator\Constraints as Assert;

class NewBusinessUserCommand
{
    /**
     * @Assert\NotBlank()
     */
    private string $businessId;

    /**
     * @Assert\NotBlank()
     */
    private string $userId;

    public function __construct(
        string $business,
        string $user
    ) {
        $this->businessId = $business;
        $this->userId = $user;
    }

    public function getBusinessId(): string
    {
        return $this->businessId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

}