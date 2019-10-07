<?php

namespace SharedKernel\Event\Bus;

use SharedKernel\Event\EventInterface;
use SharedKernel\Event\Listener\EventListenerCollection;

interface EventBusInterface
{
    /**
     * Publishes the event $event to every EventListener that wants to.
     *
     * @param EventInterface $event
     *
     * @return array data returned by each EventListener
     */

    public function publish(EventInterface $event);

    /**
     * Get the list of every EventListener defined in the EventBus.
     * This might be useful for debug.
     *
     * @return EventListenerCollection[]
     */
    public function getRegisteredEventListeners();
}
