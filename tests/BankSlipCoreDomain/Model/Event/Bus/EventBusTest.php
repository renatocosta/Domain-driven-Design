<?php

namespace Tests\BankSlipCoreDomain\Model\Event\Bus;

use BankSlipCoreDomain\Model\Document\Factories\DocumentFactory;
use BankSlipCoreDomain\Model\Document\Factories\StatusIdFactory;
use BankSlipCoreDomain\Model\Document\Entity\DocumentWasChanged;
use BankSlipCoreDomain\Model\Document\Entity\DocumentWasCreated;
use BankSlipCoreDomain\Application\Document\EventHandlers\DocumentWasCreatedEventHandler;
use PHPUnit\Framework\TestCase;
use CrossCutting\Application\Event\Bus\DomainEventBus;

class EventBusTest extends TestCase
{

    private $mockDocumentRepository;

    private $mockEnrollRepository;

    public function setUp()
    {
        $this->mockDocumentRepository = \Mockery::mock('BankSlipCoreDomain\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
        $this->mockDocumentRepository->shouldReceive('countFor')
            ->once()
            ->andReturn(0);

        $this->mockEnrollRepository = \Mockery::mock('BankSlipCoreDomain\Infrastructure\Persistence\Repositories\EnrollRepository')->makePartial();
        $this->mockEnrollRepository->shouldReceive('countFor')
            ->once()
            ->andReturn(0);

    }

    public function testShouldFailToUnsubscribedEventInHandler()
    {
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' - 1 month'));

        $entityEventHandler = new DocumentWasCreatedEventHandler($this->mockDocumentRepository, $this->mockEnrollRepository);
        $status = StatusIdFactory::create();
        $document = DocumentFactory::create($status, $dueDate, '0937373333');
        $entityEvent = new DocumentWasChanged($document);

        DomainEventBus::instance()->subscribe($entityEventHandler);
        DomainEventBus::instance()->publish($entityEvent);

        $this->assertFalse($entityEventHandler->isSubscribedTo($entityEvent));
    }

   public function testShouldSubscribeEventInHandler()
     {

         $dtActual = date('Y-m-d');
         $dueDate = date('Y-m-d', strtotime($dtActual . ' + 1 month'));
         $entityEventHandler = new DocumentWasCreatedEventHandler($this->mockDocumentRepository, $this->mockEnrollRepository);
         $status = StatusIdFactory::create();
         $document = DocumentFactory::create($status, $dueDate, '0937373333');
         $entityEvent = new DocumentWasCreated($document);

         $this->assertTrue($entityEventHandler->isSubscribedTo($entityEvent));
     }

}