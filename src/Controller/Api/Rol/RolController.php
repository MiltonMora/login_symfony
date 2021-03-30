<?php


namespace App\Controller\Api\Rol;

use App\Application\Rol\Command\GetRolesCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\Api\AbstractApiController;

/**
 *  @Route("/api/rol")
 */
class RolController extends AbstractApiController
{
    /**
     *  @Route("", methods={"GET"})
     */
    public function getRoles(Request $request) {
        $response = new JsonResponse();
        if (!$this->checkPermissions(
            $request->headers->get('authorization'),
            [self::ADMIN] )) {
            return $response->setData('Access Denied');
        }
        $result = $this->commandBus->handle(
            new GetRolesCommand()
        );

        $response->setData($result);
        return $response;
    }

}