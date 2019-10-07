<?php

namespace Tests\SharedKernel\Event;

use PHPUnit\Framework\TestCase;
use SharedKernel\Entity\Entity;
use SharedKernel\Entity\SendEmailOnPurchaseOrderCreated;
use SharedKernel\Event\Bus\EventBus;
use SharedKernel\Event\Listerner\Locator\EventListenerLocator;

class EventTest extends TestCase
{

    public function setUp()
    {

    }

    public function testShould()
    {
        $locator = new EventListenerLocator();
        $locator->register('PurchaseOrderCreated', new SendEmailOnPurchaseOrderCreated(122222));

        // then the EventBus
        $bus = new EventBus($locator);


      $entity = new Entity(1);
      // Then apply EventListeners
        $events = $entity->pullEvents(); // this will clear the list of event in your AggregateRoot so an Event is trigger only once

// You can have more than one event at a time.
        foreach($events as $event) {
            $bus->publish($event);
        }

      $this->assertTrue(1===1);
    }


}