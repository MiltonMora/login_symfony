<?php


namespace App\Application\Users;

use App\Application\Users\Command\NewUserCommand;
use App\Domain\Business\Ports\BusinessInterface;
use App\Domain\Business\Ports\BusinessUserInterface;
use App\Domain\Users\Model\User;
use App\Domain\Users\Ports\RolInterface;
use App\Domain\Users\Ports\UserInterface;
use App\Domain\Users\Ports\UserRolInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Domain\Users\Model\UserRol;
use App\Domain\Business\Model\BusinessUser;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class NewUserHandler
{
    private ValidatorInterface $validator;

    private UserInterface $user;

    private UserPasswordEncoderInterface $passwordEncoder;

    private UserRolInterface $userRolPort;

    private RolInterface $rolPort;

    private BusinessInterface $businessPort;

    private BusinessUserInterface $businessUserPort;

    private MailerInterface $mailer;

    public function __construct(
        UserInterface $user,
        ValidatorInterface $validator,
        UserPasswordEncoderInterface $passwordEncoder,
        UserRolInterface $userRolPort,
        RolInterface $rolPort,
        BusinessInterface $businessPort,
        BusinessUserInterface $businessUserPort,
        MailerInterface $mailer
    ) {
        $this->user = $user;
        $this->validator = $validator;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRolPort = $userRolPort;
        $this->rolPort = $rolPort;
        $this->businessPort = $businessPort;
        $this->businessUserPort = $businessUserPort;
        $this->mailer = $mailer;
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

            if (!empty($command->getPassword())) {
                $user->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    $command->getPassword()
                ));
            }

            $this->user->save($user);

            $rol = $this->rolPort->findByIdOrFail($command->getRol());

            $userRol = new  UserRol($user, $rol);
            $this->userRolPort->store($userRol);

            $business = $this->businessPort->getBusinessById($command->getBusinessId());
            $this->businessUserPort->store(
                new BusinessUser(
                    $business,
                    $user
                )
            );

            $email = (new TemplatedEmail())
                ->from('contact@assistance.iyoud.org')
                ->to($command->getEmail())
                ->subject('Time for Symfony Mailer!')
                ->htmlTemplate('emails/signUp.html.twig')
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'username' => 'foo',
                ]);
            $this->mailer->send($email);

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