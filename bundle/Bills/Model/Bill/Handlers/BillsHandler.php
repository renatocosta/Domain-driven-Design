<?php

namespace Bills\Model\Bill\Handlers;

use Bills\Model\Bill\Commands\Inputs\RegisterBillCommand;
use Bills\Model\Bill\Factories\DocumentFactory;
use Bills\Model\Bill\Factories\StatusIdFactory;
use Bills\Model\Bill\Repositories\IBillsRepository;
use Bills\Model\Bill\Specification\BarCodeUnique;
use Bills\Model\Bill\Specification\DocumentHasOverdueDate;
use Bills\Model\Bill\Specification\DocumentIsAbleTo;
use SharedKernel\Infrastructure\IUnitOfWorkContext;
use SharedKernel\Infrastructure\Services\IEmailService;
use SharedKernel\Model\Commands\CommandResult;
use SharedKernel\Model\Commands\ICommandResult;

class BillsHandler
{

    private $billsRepository;

    private $emailService;

    private $iUnitOfWorkContext;

    private $barCodeUnique;

    public function __construct(
                                IBillsRepository $billsRepository,
                                IEmailService $emailService,
                                IUnitOfWorkContext $iUnitOfWorkContext,
                                BarCodeUnique $barCodeUnique)
    {
        $this->billsRepository = $billsRepository;
        $this->emailService = $emailService;
        $this->iUnitOfWorkContext = $iUnitOfWorkContext;
        $this->barCodeUnique = $barCodeUnique;
    }

    public function handle(RegisterBillCommand $command): ICommandResult
    {

        $this->iUnitOfWorkContext->beginTransaction();

        $status = StatusIdFactory::create();
        $document = DocumentFactory::create($status, $command->getDueDate(), $command->getBarCode());

        if (!$document->isValid()) {
            return new CommandResult(false, 'Algumas incosistências foram identificadas', $document->fetchErrors());
        }

        if (!$this->barCodeUnique->isSatisfiedBy($document->getBarCode())) {
            return new CommandResult(false, 'O código de barras informado já existe', $command->asArray());
        }

        $this->billsRepository->create($document);

        $this->emailService->send('emailto@picpay.com', "bills@picpay.com", "Bem vindo", "Boleto registrado com sucesso!!");

        $this->iUnitOfWorkContext->commit();

        return new CommandResult(true, 'Boleto registrado com sucesso!!', [
            'status' => $document->getStatusId()
                        ->value(),
            'dueDate' => $document->getDueDate()
        ]);

    }

}