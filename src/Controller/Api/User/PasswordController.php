<?php


namespace App\Controller\Api\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\Api\AbstractApiController;
use App\Application\Users\Command\ActivateUserAndSetPasswordCommand;

class PasswordController extends AbstractApiController
{

    /**
     *  @Route("/activate-user", methods={"POST"})
     */
    public function activeUserAndGeneratePassword(Request $request)
    {
        $response = new JsonResponse();
        $result = $result = $this->commandBus->handle(
            new ActivateUserAndSetPasswordCommand(
                $request->get('userId'),
                $request->get('password')
            )
        );
        $response->setData($result);
        return $response;
    }
}