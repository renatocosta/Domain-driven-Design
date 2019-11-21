<?php

namespace Tests\BankSlipCoreDomain\Application\UseCase;

use BankSlipCoreDomain\Infrastructure\Services\EmailService;
use BankSlipCoreDomain\Infrastructure\Transaction\UnitOfWorkContext;
use BankSlipCoreDomain\Application\Document\CommandHandlers\Commands\Inputs\NewDocumentCommand;
use BankSlipCoreDomain\Application\Document\CommandHandlers\DocumentHandler;
use BankSlipCoreDomain\Model\Document\Specification\BarCodeUnique;
use CrossCutting\Application\CommandHandlers\TransactionalHandler;
use Tests\BaseUnitTestCase;


class DocumentTest extends BaseUnitTestCase
{

    public function testShouldAdd()
    {

        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual. ' + 1 month'));

        $command = new NewDocumentCommand('0987987289789278972', $dueDate);

        $mockDocumentRepository = \Mockery::mock('BankSlipCoreDomain\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
        $mockDocumentRepository->shouldReceive('countFor')
            ->once()
            ->andReturn(0);

        $barCodeUnique = new BarCodeUnique($mockDocumentRepository);
        $documentHandler = new DocumentHandler(new EmailService(), $barCodeUnique);

        $transactionalHandler = new TransactionalHandler($documentHandler, new UnitOfWorkContext());
        $result = $transactionalHandler->handle($command);

        $this->assertTrue($result->success());

    }

    public function testShouldFailToUniqueBarCodeWhenAddNewBill()
    {

        $totalBarcodeInDb = 1;
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual. ' - 2 month'));

        $command = new NewDocumentCommand('0987987289789278972', $dueDate);
        $mockDocumentRepository = \Mockery::mock('BankSlipCoreDomain\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
        $mockDocumentRepository->shouldReceive('countFor')
            ->once()
            ->andReturn($totalBarcodeInDb);

        $barCodeUnique = new BarCodeUnique($mockDocumentRepository);

        $handlers = new DocumentHandler(new EmailService(), $barCodeUnique);
        $result = $handlers->handle($command);

        $this->assertFalse($result->success());

    }

    public function testShouldFailToEmptyValuesWhenAddNewBill()
    {

        $totalBarcodeInDb = 1;
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual. ' - 8 month'));

        $command = new NewDocumentCommand('', $dueDate);
        $mockDocumentRepository = \Mockery::mock('BankSlipCoreDomain\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
        $mockDocumentRepository->shouldReceive('countFor')
            ->once()
            ->andReturn($totalBarcodeInDb);

        $barCodeUnique = new BarCodeUnique($mockDocumentRepository);

        $handlers = new DocumentHandler(new EmailService(), $barCodeUnique);
        $result = $handlers->handle($command);

        $this->assertFalse($result->success());

    }

}