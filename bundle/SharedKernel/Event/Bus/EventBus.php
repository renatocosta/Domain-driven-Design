<?php

namespace SharedKernel\Event\Bus;

use SharedKernel\Event\EventInterface;
use SharedKernel\Event\Listener\EventListenerCollection;
use SharedKernel\Event\Listener\EventListenerInterface;
use SharedKernel\Event\Listerner\Locator\EventListenerLocatorInterface;

/**
 * Implementation of EventBusInterface.
 */
class EventBus implements EventBusInterface
{
    /**
     * @var EventListenerLocatorInterface
     */
    private $locator;
    /**
     * @param EventListenerLocatorInterface $locator
     */
    public function __construct(EventListenerLocatorInterface $locator)
    {
        $this->locator = $locator;
    }
    /**
     * {@inheritdoc}
     */
    public function publish(EventInterface $event)
    {
        $listeners = $this->locator->getEventListenersForEvent($event);
        return $this->handleListenersForEvent($event, $listeners);
    }
    /**
     * {@inheritdoc}
     */
    public function getRegisteredEventListeners()
    {
        return $this->locator->getRegisteredEventListeners();
    }
    /**
     * @param EventInterface                                   $event
     * @param EventListenerCollection|EventListenerInterface[] $listeners
     *
     * @return array
     */
    private function handleListenersForEvent(EventInterface $event, $listeners)
    {
        $return = array();
        foreach ($listeners as $listener) {
            $return[] = $listener->handle($event);
        }
        return $return;
    }
}