<?php

namespace Tests\DomainBankSlipCore\Model\Event\Bus;

use DomainBankSlipCore\Application\Document\EventHandlers\DocumentWasCreatedEventHandler;
use DomainBankSlipCore\Model\Document\Entity\DocumentWasChanged;
use DomainBankSlipCore\Model\Document\Entity\DocumentWasCreated;
use DomainBankSlipCore\Model\Document\Factories\DocumentFactory;
use DomainBankSlipCore\Model\Document\Factories\StatusIdFactory;
use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use PHPUnit\Framework\TestCase;

class EventBusTest extends TestCase
{

    private $mockDocumentRepository;

    private $mockEnrollRepository;

    public function setUp()
    {
        $this->mockDocumentRepository = \Mockery::mock('DomainBankSlipCore\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
        $this->mockDocumentRepository->shouldReceive('countFor')
            ->once()
            ->andReturn(0);

        $this->mockEnrollRepository = \Mockery::mock('DomainBankSlipCore\Infrastructure\Persistence\Repositories\EnrollRepository')->makePartial();
        $this->mockEnrollRepository->shouldReceive('countFor')
            ->once()
            ->andReturn(0);

    }

    public function testShouldFailToUnsubscribedEventInHandler()
    {

        $domainEventBus = new DomainEventBus();

        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' - 1 month'));

        $entityEventHandler = new DocumentWasCreatedEventHandler($this->mockDocumentRepository,
            $this->mockEnrollRepository);
        $status = StatusIdFactory::create();
        $document = DocumentFactory::create($status, $dueDate, '0937373333', $domainEventBus);
        $entityEvent = new DocumentWasChanged($document);

        $domainEventBus->subscribe($entityEventHandler);
        $domainEventBus->publish($entityEvent);

        $this->assertFalse($entityEventHandler->isSubscribedTo($entityEvent));
    }

    public function testShouldSubscribeEventInHandler()
    {

        $domainEventBus = new DomainEventBus();

        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' + 1 month'));
        $entityEventHandler = new DocumentWasCreatedEventHandler($this->mockDocumentRepository,
            $this->mockEnrollRepository);
        $status = StatusIdFactory::create();
        $document = DocumentFactory::create($status, $dueDate, '0937373333', $domainEventBus);
        $entityEvent = new DocumentWasCreated($document);

        $this->assertTrue($entityEventHandler->isSubscribedTo($entityEvent));
    }

}