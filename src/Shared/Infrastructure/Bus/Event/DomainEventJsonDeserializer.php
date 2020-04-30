<?php

declare(strict_types = 1);

namespace Perks\Shared\Infrastructure\Bus\Event;

use Perks\Shared\Domain\Bus\Event\DomainEvent;
use Perks\Shared\Domain\Utils;
use RuntimeException;

final class DomainEventJsonDeserializer
{
    private DomainEventMapping $mapping;

    public function __construct(DomainEventMapping $mapping)
    {
        $this->mapping = $mapping;
    }

    public function deserialize(string $domainEvent): DomainEvent
    {
        $eventData  = Utils::jsonDecode($domainEvent);
        $eventName  = $eventData['data']['type'];
        $eventClass = $this->mapping->for($eventName);

        if (null === $eventClass) {
            throw new RuntimeException("The event <$eventName> doesn't exist or has no subscribers");
        }

        return $eventClass::fromPrimitives(
            $eventData['data']['attributes']['id'],
            $eventData['data']['attributes'],
            $eventData['data']['id'],
            $eventData['data']['occurred_on']
        );
    }
}
