<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\Courses\Domain;

use Perks\Mooc\Courses\Domain\CourseName;
use Perks\Tests\Shared\Domain\WordMother;

final class CourseNameMother
{
    public static function create(string $value): CourseName
    {
        return new CourseName($value);
    }

    public static function random(): CourseName
    {
        return self::create(WordMother::random());
    }
}
