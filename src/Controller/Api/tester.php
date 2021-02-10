<?php


namespace App\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\Users\Role;

/**
 *  @Route("/api")
 */
class tester extends AbstractController
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
        $data = new Role();
        $data->handle($request->get('name'));
        $response = new JsonResponse();
        $response->setData([
                "data" => $data
        ]);
        return $response;
    }

}