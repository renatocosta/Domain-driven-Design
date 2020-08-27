<?php

namespace Tests\BankSlipCoreDomain\Application\UseCase;

use CrossCutting\Domain\Application\CommandHandlers\TransactionalHandler;
use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use CrossCutting\Domain\Model\ValueObjects\Identity\Guid;
use DomainBankSlipCore\Application\Document\CommandHandlers\DocumentHandler;
use DomainBankSlipCore\Infrastructure\Document\Entities\DocumentFactory;
use DomainBankSlipCore\Infrastructure\Services\Email;
use DomainBankSlipCore\Infrastructure\Transaction\UnitOfWorkContext;
use DomainBankSlipCore\Model\Document\Specification\BarCodeUnique;
use Ramsey\Uuid\Uuid;
use Tests\BaseUnitTestCase;


class DocumentTest extends BaseUnitTestCase
{

    public function testShouldAdd()
    {

        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' + 1 month'));

        $command = new NewDocumentCommand('0987987289789278972', $dueDate);

        $documentFactory = new DocumentFactory(new DomainEventBus());
        $model = new \stdClass();

        $mockDocumentRepository = \Mockery::mock('DomainBankSlipCore\Infrastructure\Persistence\Repositories\DocumentRepository', $model, $documentFactory);
        $params = [Guid::fromString(Uuid::uuid4()->toString()), Guid::fromString(Uuid::uuid4()->toString()), Guid::fromString(Uuid::uuid4()->toString())];
        $mockDocumentRepository->shouldReceive('countFor')
            ->with($params)
            ->once()
            ->andReturn(count($params));

        $barCodeUnique = new BarCodeUnique($mockDocumentRepository);
        $documentHandler = new DocumentHandler($documentFactory->newDocument(), $mockDocumentRepository, new Email(), $barCodeUnique);

        $transactionalHandler = new TransactionalHandler($documentHandler, new UnitOfWorkContext());
        $result = $transactionalHandler->handle($command);

        $this->assertTrue($result->success());

    }

    public function testShouldFailToUniqueBarCodeWhenAddNewBill()
    {

        $totalBarcodeInDb = 1;
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' - 2 month'));

        $command = new NewDocumentCommand('0987987289789278972', $dueDate);
        $mockDocumentRepository = \Mockery::mock('BankSlipCoreDomain\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
        $mockDocumentRepository->shouldReceive('countFor')
            ->once()
            ->andReturn($totalBarcodeInDb);

        $barCodeUnique = new BarCodeUnique($mockDocumentRepository);

        $handlers = new DocumentHandler(new Email(), $barCodeUnique, new DomainEventBus());
        $result = $handlers->handle($command);

        $this->assertFalse($result->success());

    }

    public function testShouldFailToEmptyValuesWhenAddNewBill()
    {

        $totalBarcodeInDb = 1;
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' - 8 month'));

        $command = new NewDocumentCommand('', $dueDate);
        $mockDocumentRepository = \Mockery::mock('BankSlipCoreDomain\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
        $mockDocumentRepository->shouldReceive('countFor')
            ->once()
            ->andReturn($totalBarcodeInDb);

        $barCodeUnique = new BarCodeUnique($mockDocumentRepository);

        $handlers = new DocumentHandler(new Email(), $barCodeUnique, new DomainEventBus());
        $result = $handlers->handle($command);

        $this->assertFalse($result->success());

    }

}