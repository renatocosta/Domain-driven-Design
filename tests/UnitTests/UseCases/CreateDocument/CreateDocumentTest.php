<?php

namespace Tests\UnitTests\UseCases\CreateDocument;

use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use CrossCutting\Domain\Model\ValueObjects\Identity\Guid;
use DomainBankSlipCore\Application\UseCases\Document\CreateDocument\CreateDocumentInput;
use DomainBankSlipCore\Application\UseCases\Document\CreateDocument\CreateDocumentUseCase;
use DomainBankSlipCore\Infrastructure\DataAccess\DocumentFactory;
use DomainBankSlipCore\Infrastructure\DataAccess\Repositories\DocumentRepositoryFake;
use DomainBankSlipCore\Infrastructure\DataAccess\UnitOfWorkFake;
use DomainBankSlipCore\Infrastructure\Email;
use DomainBankSlipCore\Model\Document\Enums\StatusIdEnum;
use DomainBankSlipCore\Model\Document\Specification\BarCodeUnique;
use Ramsey\Uuid\Uuid;
use Tests\BaseUnitTestCase;
use Tests\UnitTests\Presenters\CreateDocumentPresenterFake;


class CreateDocumentTest extends BaseUnitTestCase
{

    public function testShouldAdd()
    {

        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' + 1 month'));

        $createDocumentPresenter = new CreateDocumentPresenterFake();

        $documentFactory = new DocumentFactory(new DomainEventBus());

        $mockDocumentRepository = \Mockery::mock(DocumentRepositoryFake::class)->makePartial();
        $params = [Guid::fromString(Uuid::uuid4()->toString()), Guid::fromString(Uuid::uuid4()->toString()), Guid::fromString(Uuid::uuid4()->toString())];
        $mockDocumentRepository->shouldReceive('countFor')
            ->with($params)
            ->once()
            ->andReturn(count($params));

        $barCodeUnique = new BarCodeUnique($mockDocumentRepository);

        $createDocument = new CreateDocumentUseCase($documentFactory->newDocument(), $mockDocumentRepository, new Email(), $barCodeUnique, new UnitOfWorkFake());
        $createDocument->setOutputPort($createDocumentPresenter);
        $createDocument->execute(new CreateDocumentInput(StatusIdEnum::STATUS_SCHEDULED, $dueDate, '180820080982792'));
    
        $this->assertTrue($createDocumentPresenter->modelState->isValid());

    }

   /* public function testShouldFailToUniqueBarCodeWhenAddNewBill()
    {

        $totalBarcodeInDb = 1;
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual . ' - 2 month'));

        $command = new NewDocumentCommand('0987987289789278972', $dueDate);
        $mockDocumentRepository = \Mockery::mock('DomainBankSlipCore\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
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
        $mockDocumentRepository = \Mockery::mock('DomainBankSlipCore\Infrastructure\Persistence\Repositories\DocumentRepository')->makePartial();
        $mockDocumentRepository->shouldReceive('countFor')
            ->once()
            ->andReturn($totalBarcodeInDb);

        $barCodeUnique = new BarCodeUnique($mockDocumentRepository);

        $handlers = new DocumentHandler(new Email(), $barCodeUnique, new DomainEventBus());
        $result = $handlers->handle($command);

        $this->assertFalse($result->success());

    }*/

}