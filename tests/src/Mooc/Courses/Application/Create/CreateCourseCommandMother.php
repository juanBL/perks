<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\Courses\Application\Create;

use Perks\Mooc\Courses\Application\Create\CreateCourseCommand;
use Perks\Mooc\Courses\Domain\CourseDuration;
use Perks\Mooc\Courses\Domain\CourseName;
use Perks\Mooc\Shared\Domain\Course\CourseId;
use Perks\Tests\Mooc\Courses\Domain\CourseDurationMother;
use Perks\Tests\Mooc\Courses\Domain\CourseIdMother;
use Perks\Tests\Mooc\Courses\Domain\CourseNameMother;

final class CreateCourseCommandMother
{
    public static function create(CourseId $id, CourseName $name, CourseDuration $duration): CreateCourseCommand
    {
        return new CreateCourseCommand($id->value(), $name->value(), $duration->value());
    }

    public static function random(): CreateCourseCommand
    {
        return self::create(CourseIdMother::random(), CourseNameMother::random(), CourseDurationMother::random());
    }
}
