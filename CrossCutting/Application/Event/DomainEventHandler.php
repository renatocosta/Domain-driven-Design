<?php

namespace CrossCutting\Application\Event;

interface DomainEventHandler
{
    /**
     * Handling an event and then dispatcher to another aggregate root
     * @param AbstractEvent $aDomainEvent
     */
    public function handle(AbstractEvent $aDomainEvent): void;

    /**
     * Check if an event is subscribed in one event handler
     * @param AbstractEvent $aDomainEvent
     * @return bool
     */
    public function isSubscribedTo(AbstractEvent $aDomainEvent): bool;

}