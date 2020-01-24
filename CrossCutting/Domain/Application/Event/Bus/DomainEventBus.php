<?php

namespace CrossCutting\Domain\Application\Event\Bus;

use CrossCutting\DataManagement\Collection\Collection;
use CrossCutting\DataManagement\Collection\DefaultIterator;
use CrossCutting\Domain\Application\Event\AbstractEvent;
use CrossCutting\Domain\Application\Event\DomainEventHandler;

class DomainEventBus
{

    /**
     * @var Collection
     */
    private $eventHandlers;

    /**
     * @var DefaultIterator
     */
    private $iterator;

    public function __construct()
    {
        $this->eventHandlers = new Collection();
        $this->iterator = $this->eventHandlers->getIterator();
    }

    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }

    public function subscribe(DomainEventHandler $aDomainEventHandler): void
    {
        $this->eventHandlers->add($aDomainEventHandler);
    }

    public function publish(AbstractEvent $aDomainEvent): void
    {

        while ($this->iterator->valid()) {

            $eventHandler = $this->iterator->current();

            if ($eventHandler->isSubscribedTo($aDomainEvent)) {
                $eventHandler->handle($aDomainEvent);
                break;
            }

            $this->iterator->next();
        }

    }

}
