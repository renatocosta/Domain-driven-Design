<?php

namespace Tests\Bills\Model\Event\Bus;

use Bills\Model\Bills\Entity\DocumentWasChanged;
use Bills\Model\Bills\Entity\DocumentWasCreated;
use Bills\Model\Bills\Entity\DocumentWasCreatedEventHandler;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use SharedKernel\Model\Event\Bus\DomainEventBus;
use SharedKernel\Model\ValueObjects\Identity\Guid;

class EventBusTest extends TestCase
{

    public function testShouldFailToUnsubscribedEventInHandler()
    {
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' - 1 month'));

        $entityEventHandler = new DocumentWasCreatedEventHandler('aggregateRootDispatcherPutRightHere');
        $entityEvent = new DocumentWasChanged(Guid::fromString(Uuid::uuid4()->toString()), '22222211', $dueDate);

        DomainEventBus::instance()->subscribe($entityEventHandler);
        DomainEventBus::instance()->publish($entityEvent);

        $this->assertFalse($entityEventHandler->isSubscribedTo($entityEvent));
    }

    public function testShouldSubscribeEventInHandler()
    {

        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' + 1 month'));

        $entityEventHandler = new DocumentWasCreatedEventHandler('aggregateRootDispatcherPutRightHere');
        $entityEvent = new DocumentWasCreated(Guid::fromString(Uuid::uuid4()->toString()), '444114444444', $dueDate);

        $this->assertTrue($entityEventHandler->isSubscribedTo($entityEvent));
    }

}