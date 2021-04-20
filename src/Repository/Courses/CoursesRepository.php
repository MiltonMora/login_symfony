<?php

namespace App\Repository\Courses;

use App\Domain\Courses\Model\Courses;
use App\Domain\Courses\Ports\CourseInterface;
use App\Repository\BaseRepository;

class CoursesRepository extends BaseRepository implements CourseInterface
{
    protected static function entityClass(): string
    {
        return Courses::class;
    }

    public function save(Courses $courses): void
    {
        $this->saveEntity($courses);
    }

}