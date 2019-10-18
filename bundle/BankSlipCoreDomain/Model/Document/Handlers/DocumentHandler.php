<?php

namespace BankSlipCoreDomain\Model\Document\Handlers;

use BankSlipCoreDomain\Model\Document\Commands\Inputs\NewDocumentCommand;
use BankSlipCoreDomain\Model\Document\Factories\DocumentFactory;
use BankSlipCoreDomain\Model\Document\Factories\StatusIdFactory;
use BankSlipCoreDomain\Model\Document\Repositories\IDocumentRepository;
use BankSlipCoreDomain\Model\Document\Specification\BarCodeUnique;
use BankSlipCoreDomain\Model\Document\Specification\DocumentHasOverdueDate;
use BankSlipCoreDomain\Model\Document\Specification\DocumentIsAbleTo;
use SharedKernel\Infrastructure\IUnitOfWorkContext;
use SharedKernel\Infrastructure\Services\IEmailService;
use SharedKernel\Model\Commands\CommandResult;
use SharedKernel\Model\Commands\ICommandResult;

class DocumentHandler
{

    private $billsRepository;

    private $emailService;

    private $iUnitOfWorkContext;

    private $barCodeUnique;

    public function __construct(
                                IDocumentRepository $billsRepository,
                                IEmailService $emailService,
                                IUnitOfWorkContext $iUnitOfWorkContext,
                                BarCodeUnique $barCodeUnique)
    {
        $this->billsRepository = $billsRepository;
        $this->emailService = $emailService;
        $this->iUnitOfWorkContext = $iUnitOfWorkContext;
        $this->barCodeUnique = $barCodeUnique;
    }

    public function handle(NewDocumentCommand $command): ICommandResult
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

        $this->emailService->send('emailto@picpay.com', "bills@picpay.com", "Bem vindo", "Boleto registrado com sucesso!!");

        $this->iUnitOfWorkContext->commit();

        return new CommandResult(true, 'Boleto registrado com sucesso!!', [
            'status' => $document->getStatusId()
                        ->value(),
            'dueDate' => $document->getDueDate()
        ]);

    }

}