<?php


namespace App\Application\Courses;


use App\Application\Courses\Command\NewCourseCommand;
use App\Domain\Courses\Ports\CourseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Domain\Courses\Model\Courses;

class NewCourseHandler
{
    private ValidatorInterface $validator;

    private CourseInterface $coursePort;

    public function __construct(
        ValidatorInterface $validator,
        CourseInterface $coursePort
    ) {
        $this->validator = $validator;
        $this->coursePort = $coursePort;
    }


    public function handle(NewCourseCommand $command) {
        $errors = $this->validator->validate($command);
        if (count($errors) > 0) {
            return $errorsString = (string) $errors;
        }

        $course = new Courses(
            $command->getName()
        );

        return $this->coursePort->save($course);

    }

}