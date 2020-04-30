<?php

declare(strict_types = 1);

namespace Perks\Tests\Mooc\CoursesCounter\Domain;

use Perks\Mooc\CoursesCounter\Domain\CoursesCounter;
use Perks\Mooc\CoursesCounter\Domain\CoursesCounterId;
use Perks\Mooc\CoursesCounter\Domain\CoursesCounterIncrementedDomainEvent;
use Perks\Mooc\CoursesCounter\Domain\CoursesCounterTotal;

final class CoursesCounterIncrementedDomainEventMother
{
    public static function create(
        CoursesCounterId $id,
        CoursesCounterTotal $total
    ): CoursesCounterIncrementedDomainEvent {
        return new CoursesCounterIncrementedDomainEvent($id->value(), $total->value());
    }

    public static function fromCounter(CoursesCounter $counter): CoursesCounterIncrementedDomainEvent
    {
        return self::create($counter->id(), $counter->total());
    }

    public static function random(): CoursesCounterIncrementedDomainEvent
    {
        return self::create(CoursesCounterIdMother::random(), CoursesCounterTotalMother::random());
    }
}
