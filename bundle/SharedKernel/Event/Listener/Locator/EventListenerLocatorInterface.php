<?php

namespace SharedKernel\Event\Listerner\Locator;

use SharedKernel\Event\EventInterface;
use SharedKernel\Event\Listener\EventListenerCollection;

/**
 * The purpose of this interface is to connect EventListeners to their Event.
 * You can have multiple Locator if you want to have multiple EventBus.
 */
interface EventListenerLocatorInterface
{
    /**
     * Get the list of every event listeners that want to be warn when the event specified in argument is published.
     *
     * @param EventInterface $event
     *
     * @return EventListenerCollection
     */
    public function getEventListenersForEvent(EventInterface $event);

    /**
     * @return EventListenerCollection[]
     */
    public function getRegisteredEventListeners();

}