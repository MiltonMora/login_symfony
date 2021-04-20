<?php


namespace App\Controller\Api\Courses;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\Api\AbstractApiController;
use App\Application\Courses\Command\NewCourseCommand;

/**
 *  @Route("/api/course")
 */
class CoursesController extends AbstractApiController
{

    /**
     *  @Route("/{id}", methods={"GET"})
     */
    public function getDataUsers($id = null, Request $request) {
        $response = new JsonResponse();
        if (!$this->checkPermissions(
            $request->headers->get('authorization'),
            [self::SUPERADMIN] )) {
            return $response->setData('Access Denied');
        }
        $result = true;

        $response->setData($result);
        return $response;
    }

    /**
     *  @Route("/new", methods={"POST"})
     */
    public function newCourse(Request $request)
    {
        $response = new JsonResponse();
        if (!$this->checkPermissions(
            $request->headers->get('authorization'),
            [self::SUPERADMIN] )) {
            return $response->setData('Access Denied');
        }

        $result = $this->commandBus->handle(
            new NewCourseCommand(
                $request->get('name'),
                $request->get('startDate'),
                $request->get('teacher')
            )
        );
        $response->setData($result);
        return $response;
    }

  
}