<?php

namespace App\Application\Courses\Command;

use Symfony\Component\Validator\Constraints as Assert;

class NewCourseCommand {
    
    /**
     * @Assert\NotBlank()
     */
    private string $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Date
     */
    private string $startDate;

    /**
     * @Assert\NotBlank()
     */
    private string $teacher;

    public function __construct(
        string $name,
        string $startDate,
        string $teacher
    ) {
        $this->name = $name;
        $this->startDate = $startDate;
        $this->teacher = $teacher;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getTeacher(): string
    {
        return $this->teacher;
    }



}