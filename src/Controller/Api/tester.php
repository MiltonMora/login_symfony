<?php


namespace App\Controller\Api;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\Users\Command\RolCommand;
use App\Controller\Api\AbstractApiController;


/**
 *  @Route("/api")
 */
class tester extends AbstractApiController
{
    /**
     *  @Route("/hello", methods={"GET"})
     */
    public function hello()
    {
        $response = new JsonResponse();
        $response->setData(
            [
            ]);
        return $response;
    }

    /**
     *  @Route("/new-profile", methods={"POST"})
     */
    public function newProfile(Request $request)
    {
        $result = $this->commandBus->handle(
            new RolCommand($request->get('name'))
        );
        $response = new JsonResponse();
        $response->setData([
                "data" => $result
        ]);
        return $response;
    }

}