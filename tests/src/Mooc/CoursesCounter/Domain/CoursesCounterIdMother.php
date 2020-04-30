<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\CoursesCounter\Domain;

use Perks\Mooc\CoursesCounter\Domain\CoursesCounterId;
use Perks\Tests\Shared\Domain\UuidMother;

final class CoursesCounterIdMother
{
    public static function create(string $value): CoursesCounterId
    {
        return new CoursesCounterId($value);
    }

    public static function random(): CoursesCounterId
    {
        return self::create(UuidMother::random());
    }
}
