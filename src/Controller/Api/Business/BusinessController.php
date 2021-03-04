<?php


namespace App\Controller\Api\Business;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\Api\AbstractApiController;
use App\Application\Business\Command\NewBusinessCommand;

/**
 *  @Route("/api/business")
 */
class BusinessController extends AbstractApiController
{

    /**
     *  @Route("/new/business", methods={"POST"})
     */
    public function newBusiness(Request $request)
    {
        $response = new JsonResponse();
        if (!$this->checkPermissions(
            $request->headers->get('authorization'),
            self::SUPERADMIN )) {
            return $response->setData('Access Denied');
        }

        $result = $this->commandBus->handle(
            new NewBusinessCommand(
                $request->get('name'),
                $request->get('email'),
                $request->get('address'),
                $request->get('in')
            )
        );
        $response->setData($result);
        return $response;
    }

}