<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\Courses\Domain;

use Perks\Mooc\Courses\Domain\CourseDuration;
use Perks\Tests\Shared\Domain\IntegerMother;
use Perks\Tests\Shared\Domain\RandomElementPicker;

final class CourseDurationMother
{
    public static function create(string $value): CourseDuration
    {
        return new CourseDuration($value);
    }

    public static function random(): CourseDuration
    {
        return self::create(
            sprintf(
                '%s %s',
                IntegerMother::lessThan(100),
                RandomElementPicker::from('months', 'years', 'days', 'hours', 'minutes', 'seconds')
            )
        );
    }
}
