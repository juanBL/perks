<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\Courses\Domain;

use Perks\Mooc\Courses\Domain\Course;
use Perks\Mooc\Courses\Domain\CourseCreatedDomainEvent;
use Perks\Mooc\Courses\Domain\CourseDuration;
use Perks\Mooc\Courses\Domain\CourseName;
use Perks\Mooc\Shared\Domain\Course\CourseId;

final class CourseCreatedDomainEventMother
{
    public static function create(CourseId $id, CourseName $name, CourseDuration $duration): CourseCreatedDomainEvent
    {
        return new CourseCreatedDomainEvent($id->value(), $name->value(), $duration->value());
    }

    public static function fromCourse(Course $course): CourseCreatedDomainEvent
    {
        return self::create($course->id(), $course->name(), $course->duration());
    }

    public static function random(): CourseCreatedDomainEvent
    {
        return self::create(CourseIdMother::random(), CourseNameMother::random(), CourseDurationMother::random());
    }
}
