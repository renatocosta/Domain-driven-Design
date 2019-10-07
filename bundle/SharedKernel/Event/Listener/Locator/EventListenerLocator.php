<?php

namespace SharedKernel\Event\Listerner\Locator;

use SharedKernel\Event\EventInterface;
use SharedKernel\Event\Listener\EventListenerCollection;
use SharedKernel\Event\Listener\EventListenerInterface;

/**
 * Implementation of EventListenerLocatorInterface.
 */
class EventListenerLocator implements EventListenerLocatorInterface
{
    /**
     * @var EventListenerCollection[]
     */
    private $listeners = array();

    public function getEventListenersForEvent(EventInterface $event)
    {

        $fullClassName     = get_class($event);
        $eventClassName = substr(strrchr($fullClassName, "\\"), 1);

        $listenerCollection = new EventListenerCollection($eventClassName);

        if (array_key_exists($eventClassName, $this->listeners)) {
            $listenerCollection = $this->listeners[$eventClassName];
        }
        return $listenerCollection;
    }

    public function getRegisteredEventListeners()
    {
        $listeners = array();
        foreach ($this->listeners as $listenerCollection) {
            $listeners[] = $listenerCollection;
        }
        return $listeners;
    }

    /**
     * @param string                 $eventClassName
     * @param EventListenerInterface $eventListener
     */
    public function register($eventClassName, EventListenerInterface $eventListener)
    {
        if (!array_key_exists($eventClassName, $this->listeners)) {
            $this->listeners[$eventClassName] = new EventListenerCollection($eventClassName);
        }

        $this->listeners[$eventClassName]->add($eventListener);
    }

}