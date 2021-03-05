<?php


namespace App\Controller\Api\User;

use App\Application\Users\Command\NewRolCommand;
use App\Application\Users\Command\NewUserRolCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\Api\AbstractApiController;
use App\Application\Users\Command\NewUserCommand;

/**
 *  @Route("/api/user")
 */
class UserController extends AbstractApiController
{

    /**
     *  @Route("/new/user", methods={"POST"})
     */
    public function newUserAndRol(Request $request)
    {
        $response = new JsonResponse();
        if (!$this->checkPermissions(
            $request->headers->get('authorization'),
            self::SUPERADMIN )) {
            return $response->setData('Access Denied');
        }

        $result = $this->commandBus->handle(
            new NewUserCommand(
                $request->get('name'),
                $request->get('email'),
                $request->get('password'),
                $request->get('rol'),
                $request->get('business')
            )
        );
        $response->setData($result);
        return $response;
    }

    /**
     *  @Route("/new-profile", methods={"POST"})
     */
    public function newProfile(Request $request)
    {
        $response = new JsonResponse();
        if (!$this->checkPermissions(
            $request->headers->get('authorization'),
            self::SUPERADMIN )) {
            return $response->setData('Access Denied');
        }
        $result = $this->commandBus->handle(
            new NewRolCommand($request->get('name'))
        );
        $response->setData($result);
        return $response;
    }

    /**
     *  @Route("/new/user-profile", methods={"POST"})
     */
    public function newUserProfile(Request $request)
    {
        $response = new JsonResponse();
        if (!$this->checkPermissions(
            $request->headers->get('authorization'),
            self::SUPERADMIN )) {
            return $response->setData('Access Denied');
        }
        $result = $this->commandBus->handle(
            new NewUserRolCommand(
                $request->get('email'),
                $request->get('rol')
            )
        );
        $response->setData($result);
        return $response;
    }

}