<?php


namespace App\Application\Business\Command;

use Symfony\Component\Validator\Constraints as Assert;

class NewBusinessCommand
{

    /**
     * @Assert\NotBlank()
     */
    private string $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private string $email;

    /**
     * @Assert\NotBlank()
     */
    private string $address;

    /**
     * @Assert\NotBlank()
     */
    private string $idn;

    /**
     * NewBusinessCommand constructor.
     * @param string $name
     * @param string $email
     * @param string $address
     * @param string $in
     */
    public function __construct(
        string $name,
        string $email,
        string $address,
        string $in
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->idn = $in;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getIdn(): string
    {
        return $this->idn;
    }



}