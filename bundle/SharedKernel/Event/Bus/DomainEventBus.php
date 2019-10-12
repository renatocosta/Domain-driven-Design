<?php

namespace SharedKernel\Event\Bus;

use SharedKernel\Event\EventDispatcherInterface;
use SharedKernel\Event\AbstractEvent;
use SharedKernel\Event\DomainEventHandler;

class DomainEventBus {

    /**
     * @var DomainEventHandler[]
     */
    private $eventHandlers;

    /**
     * @var DomainEventBus
     */
    private static $instance = null;

    /**
     * @var int
     */
    private $id = 0;

    public static function instance(): self
    {

        if (null === static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    private function __construct()
    {
        $this->eventHandlers = [];
    }

    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }

    public function subscribe(DomainEventHandler $aDomainEventHandler): void
    {
        $id = $this->id;
        $this->eventHandlers[$id] = $aDomainEventHandler;
        $this->id++;
    }

    public function publish(AbstractEvent $aDomainEvent): void
    {
        foreach ($this->eventHandlers as $aEventHandler) {
            if ($aEventHandler->isSubscribedTo($aDomainEvent)) {
                $aEventHandler->handle($aDomainEvent);
            }
        }
    }

}
