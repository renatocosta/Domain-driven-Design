<?php

namespace Tests\SharedKernel\Model\Event\Bus;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use SharedKernel\Sample\Entity\EntityEventHandler;
use SharedKernel\Sample\Entity\EntityWasChanged;
use SharedKernel\Sample\Entity\EntityWasCreated;
use SharedKernel\Model\ValueObjects\Identity\Guid;

class EventBusTest extends TestCase
{

    public function testShouldFailToUnsubscribedEventInHandler()
    {

        $entityEventHandler = new EntityEventHandler('aggregateRootDispatcherPutRightHere');
        $entityEvent = new EntityWasChanged(Guid::fromString(Uuid::uuid4()->toString()));

        $this->assertFalse($entityEventHandler->isSubscribedTo($entityEvent));
    }

    public function testShouldSubscribeEventInHandler()
    {

        $entityEventHandler = new EntityEventHandler('aggregateRootDispatcherPutRightHere');
        $entityEvent = new EntityWasCreated(Guid::fromString(Uuid::uuid4()->toString()));

        $this->assertTrue($entityEventHandler->isSubscribedTo($entityEvent));
    }

}