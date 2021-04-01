<?php


namespace App\Application\Users;


use App\Application\Users\Command\ChangeStatusCommand;
use App\Domain\Users\Ports\UserInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ChangeStatusHandler
{
    private ValidatorInterface $validator;

    private UserInterface $user;

    private MailerInterface $mailer;

    public function __construct(
        ValidatorInterface $validator,
        UserInterface $user,
        MailerInterface $mailer
    ) {
        $this->validator = $validator;
        $this->user = $user;
        $this->mailer = $mailer;
    }

    public function handle(ChangeStatusCommand $command)
    {
        $errors = $this->validator->validate($command);

        if (count($errors) > 0) {
            return $errorsString = (string) $errors;
        }
        try {
            $response = "";
            $user = $this->user->findOneByEmailOrFail($command->getEmail());
            $user->setPassword('');
            if($user->isStatus()) {
                $user->setStatus(0);
                $this->user->save($user);
                $response = "Usuario inactivado correctamente";
            }
            else {
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
                $response = "se ha enviado un email a la direccion ".$command->getEmail()."para que el usuario finalice el proceso de activacion";
            }
            return [
                "message" => $response,
                "status" => 200
            ];
        }
        catch (\Exception $e) {
            return [
                "message" => $e,
                "status" => 404
            ];
        }
    }

}