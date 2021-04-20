<?php


namespace App\Domain\Courses\Ports;

use App\Domain\Courses\Model\Courses;

interface CourseInterface
{
    public function save(Courses $Course);

}