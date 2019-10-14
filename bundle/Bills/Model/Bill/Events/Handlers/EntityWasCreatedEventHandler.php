<?php

namespace SharedKernel\Sample\Entity;

use SharedKernel\Model\Event\AbstractEvent;
use SharedKernel\Model\Event\DomainEventHandler;

class EntityWasCreatedEventHandler implements DomainEventHandler
{

    private $aggregateRootDispatcher;

    public function __construct($aggregateRootDispatcher)
    {
        $this->aggregateRootDispatcher = $aggregateRootDispatcher;
    }

    public function handle(AbstractEvent $aDomainEvent): void
    {
        //Put here some dispatcher to call another aggregate root
        //$aDomainEvent->getId()
        //$this->aggregateRootDispatcher->dispatch();
    }

    public function isSubscribedTo(AbstractEvent $aDomainEvent): bool
    {
        return $aDomainEvent instanceof DocumentWasCreated;
    }

}