<?php

namespace SharedKernel\Sample\Entity;

use SharedKernel\Event\AbstractEvent;
use SharedKernel\Event\DomainEventHandler;

class EntityEventHandler implements DomainEventHandler
{

    private $eventName;

    public function __construct(string $eventName)
    {
        $this->eventName = $eventName;
    }

    public function handle(AbstractEvent $aDomainEvent): void
    {

    }

    public function isSubscribedTo(AbstractEvent $aDomainEvent): bool
    {
        return $aDomainEvent->getEventName() === $this->eventName;
    }

}