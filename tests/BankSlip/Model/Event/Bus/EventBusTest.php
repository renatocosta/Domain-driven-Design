<?php

namespace Tests\BankSlipCoreDomain\Model\Event\Bus;

use BankSlipCoreDomain\Model\Document\Factories\DocumentFactory;
use BankSlipCoreDomain\Model\Document\Factories\StatusIdFactory;
use BankSlipCoreDomain\Model\Document\Entity\DocumentWasChanged;
use BankSlipCoreDomain\Model\Document\Entity\DocumentWasCreated;
use BankSlipCoreDomain\Model\Document\Entity\DocumentWasCreatedEventHandler;
use PHPUnit\Framework\TestCase;
use SharedKernel\Model\Event\Bus\DomainEventBus;

class EventBusTest extends TestCase
{

    private $mockDocumentRepository;

    private $mockRegistryRepository;

    public function setUp()
    {
        $this->mockDocumentRepository = \Mockery::mock('BankSlipCoreDomain\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
        $this->mockDocumentRepository->shouldReceive('countFor')
            ->once()
            ->andReturn(0);

        $this->mockRegistryRepository = \Mockery::mock('BankSlipCoreDomain\Infrastructure\Persistence\Repositories\RegistryRepository')->makePartial();
        $this->mockRegistryRepository->shouldReceive('countFor')
            ->once()
            ->andReturn(0);

    }

    public function testShouldFailToUnsubscribedEventInHandler()
    {
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' - 1 month'));

        $entityEventHandler = new DocumentWasCreatedEventHandler($this->mockDocumentRepository, $this->mockRegistryRepository);
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

         $entityEventHandler = new DocumentWasCreatedEventHandler($this->mockDocumentRepository, $this->mockRegistryRepository);
         $status = StatusIdFactory::create();
         $document = DocumentFactory::create($status, $dueDate, '0937373333');
         $entityEvent = new DocumentWasCreated($document);

         $this->assertTrue($entityEventHandler->isSubscribedTo($entityEvent));
     }

}