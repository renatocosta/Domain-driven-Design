<?php

namespace Tests\SharedKernel\Model\Event\Bus;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use SharedKernel\Sample\Entity\EntityWasCreatedEventHandler;
use SharedKernel\Sample\Entity\DocumentWasChanged;
use SharedKernel\Sample\Entity\DocumentWasCreated;
use SharedKernel\Model\ValueObjects\Identity\Guid;

class EventBusTest extends TestCase
{

    public function testShouldFailToUnsubscribedEventInHandler()
    {

        $entityEventHandler = new EntityWasCreatedEventHandler('aggregateRootDispatcherPutRightHere');
        $entityEvent = new DocumentWasChanged(Guid::fromString(Uuid::uuid4()->toString()));

        $this->assertFalse($entityEventHandler->isSubscribedTo($entityEvent));
    }

    public function testShouldSubscribeEventInHandler()
    {

        $entityEventHandler = new EntityWasCreatedEventHandler('aggregateRootDispatcherPutRightHere');
        $entityEvent = new DocumentWasCreated(Guid::fromString(Uuid::uuid4()->toString()));

        $this->assertTrue($entityEventHandler->isSubscribedTo($entityEvent));
    }

}