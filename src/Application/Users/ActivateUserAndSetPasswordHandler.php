<?php


namespace App\Application\Users;

use App\Application\Users\Command\ActivateUserAndSetPasswordCommand;
use App\Domain\Users\Ports\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ActivateUserAndSetPasswordHandler
{
    private ValidatorInterface $validator;

    private UserInterface $user;

    private UserPasswordEncoderInterface $passwordEncoder;

    private MailerInterface $mailer;

    public function __construct(
        UserInterface $user,
        ValidatorInterface $validator,
        UserPasswordEncoderInterface $passwordEncoder,
        MailerInterface $mailer
    ) {
        $this->user = $user;
        $this->validator = $validator;
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
    }

    public function handle(ActivateUserAndSetPasswordCommand $command)
    {
        $errors = $this->validator->validate($command);

        if (count($errors) > 0) {
            return $errorsString = (string) $errors;
        }

        try {
            $user = $this->user->findById($command->getUserId());

            $user->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    $command->getPassword()
             ));
            $user->setStatus(true);

            $this->user->save($user);

            $email = (new TemplatedEmail())
                ->from('contact@assistance.iyoud.org')
                ->to($user->getEmail())
                ->subject('Usuario activado con exito!')
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