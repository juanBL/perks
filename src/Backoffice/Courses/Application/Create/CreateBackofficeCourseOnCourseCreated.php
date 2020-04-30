<?php

declare(strict_types = 1);

namespace Perks\Backoffice\Courses\Application\Create;

use Perks\Mooc\Courses\Domain\CourseCreatedDomainEvent;
use Perks\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class CreateBackofficeCourseOnCourseCreated implements DomainEventSubscriber
{
    private BackofficeCourseCreator $creator;

    public function __construct(BackofficeCourseCreator $creator)
    {
        $this->creator = $creator;
    }

    public static function subscribedTo(): array
    {
        return [CourseCreatedDomainEvent::class];
    }

    public function __invoke(CourseCreatedDomainEvent $event): void
    {
        $this->creator->create($event->aggregateId(), $event->name(), $event->duration());
    }
}
