<?php

declare(strict_types = 1);

namespace Perks\Tests\Shared\Infrastructure\Bus\Event\RabbitMq;

use Perks\Mooc\Courses\Domain\CourseCreatedDomainEvent;
use Perks\Mooc\CoursesCounter\Domain\CoursesCounterIncrementedDomainEvent;
use Perks\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class TestAllWorksOnRabbitMqEventsPublished implements DomainEventSubscriber
{
    public static function subscribedTo(): array
    {
        return [
            CourseCreatedDomainEvent::class,
            CoursesCounterIncrementedDomainEvent::class,
        ];
    }

    /** @param CourseCreatedDomainEvent|CoursesCounterIncrementedDomainEvent $event */
    public function __invoke($event)
    {
    }
}
