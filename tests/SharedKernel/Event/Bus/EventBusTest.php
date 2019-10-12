<?php

namespace Tests\SharedKernel\Event\Bus;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use SharedKernel\Sample\Entity\EntityEventHandler;
use SharedKernel\Sample\Entity\EntityWasCreated;
use SharedKernel\ValueObjects\Identity\Guid;

class EventBusTest extends TestCase
{

    public function testShouldFailToUnsubscribedEventInHandler()
    {

        $entityEventHandler = new EntityEventHandler('EntityWasCreated22');
        $entityEvent = new EntityWasCreated(Guid::fromString(Uuid::uuid4()->toString()));

        $this->assertFalse($entityEventHandler->isSubscribedTo($entityEvent));
    }

}