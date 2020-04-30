<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\CoursesCounter\Application\Find;

use Perks\Mooc\CoursesCounter\Application\Find\CoursesCounterResponse;
use Perks\Mooc\CoursesCounter\Domain\CoursesCounterTotal;
use Perks\Tests\Mooc\CoursesCounter\Domain\CoursesCounterTotalMother;

final class CoursesCounterResponseMother
{
    public static function create(CoursesCounterTotal $total): CoursesCounterResponse
    {
        return new CoursesCounterResponse($total->value());
    }

    public static function random(): CoursesCounterResponse
    {
        return self::create(CoursesCounterTotalMother::random());
    }
}
