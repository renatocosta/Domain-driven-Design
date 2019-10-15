<?php

namespace Tests\Bills\Infrastructure\UseCase;

use Bills\Infrastructure\Services\EmailService;
use Bills\Model\Bill\Commands\Inputs\RegisterBillCommand;
use Bills\Model\Bill\Handlers\BillsHandler;
use Bills\Model\Bill\Specification\BarCodeUnique;
use Product\Infrastructure\Transaction\UnitOfWorkContext;
use Tests\BaseUnitTestCase;

class BillTest extends BaseUnitTestCase
{

   public function testShouldAdd()
    {

        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual. ' + 1 month'));

        $command = new RegisterBillCommand('0987987289789278972', $dueDate);
        $mockBillsRepository = \Mockery::mock('Bills\Infrastructure\Persistence\Repositories\BillsRepository')->makePartial();
        $mockBillsRepository->shouldReceive('countFor')
            ->once()
            ->andReturn(0);

        $barCodeUnique = new BarCodeUnique($mockBillsRepository);

        $handlers = new BillsHandler($mockBillsRepository, new EmailService(), new UnitOfWorkContext(), $barCodeUnique);
        $result = $handlers->handle($command);

        $this->assertTrue($result->success());

    }

    public function testShouldFailToUniqueBarCodeWhenAddNewBill()
    {

        $totalBarcodeInDb = 1;
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual. ' - 2 month'));

        $command = new RegisterBillCommand('0987987289789278972', $dueDate);
        $mockBillsRepository = \Mockery::mock('Bills\Infrastructure\Persistence\Repositories\BillsRepository')->makePartial();
        $mockBillsRepository->shouldReceive('countFor')
            ->once()
            ->andReturn($totalBarcodeInDb);

        $barCodeUnique = new BarCodeUnique($mockBillsRepository);

        $handlers = new BillsHandler($mockBillsRepository, new EmailService(), new UnitOfWorkContext(), $barCodeUnique);
        $result = $handlers->handle($command);

        $this->assertFalse($result->success());

    }

    public function testShouldFailToEmptyValuesWhenAddNewBill()
    {

        $totalBarcodeInDb = 1;
        $dtActual = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dtActual. ' - 8 month'));

        $command = new RegisterBillCommand('', $dueDate);
        $mockBillsRepository = \Mockery::mock('Bills\Infrastructure\Persistence\Repositories\BillsRepository')->makePartial();
        $mockBillsRepository->shouldReceive('countFor')
            ->once()
            ->andReturn($totalBarcodeInDb);

        $barCodeUnique = new BarCodeUnique($mockBillsRepository);

        $handlers = new BillsHandler($mockBillsRepository, new EmailService(), new UnitOfWorkContext(), $barCodeUnique);
        $result = $handlers->handle($command);

        $this->assertFalse($result->success());

    }

}