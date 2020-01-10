<?php

namespace BankSlipCoreDomain\Application\Document\CommandHandlers;

use BankSlipCoreDomain\Application\Document\CommandHandlers\Commands\Inputs\NewDocumentCommand;
use BankSlipCoreDomain\Model\Document\Factories\DocumentFactory;
use BankSlipCoreDomain\Model\Document\Factories\StatusIdFactory;
use BankSlipCoreDomain\Model\Document\Specification\BarCodeUnique;
use BankSlipCoreDomain\Model\Document\Specification\DocumentHasOverdueDate;
use BankSlipCoreDomain\Model\Document\Specification\DocumentIsAbleTo;
use CrossCutting\Domain\Application\CommandHandlers\Commands\Inputs\ICommand;
use CrossCutting\Domain\Application\CommandHandlers\Commands\Outputs\CommandResult;
use CrossCutting\Domain\Application\CommandHandlers\Commands\Outputs\ICommandResult;
use CrossCutting\Domain\Application\CommandHandlers\ICommandHandler;
use CrossCutting\Domain\Infrastructure\Services\IEmailService;

class DocumentHandler implements ICommandHandler
{

    private $emailService;

    private $barCodeUniqueSpec;

    public function __construct(
        IEmailService $emailService,
        BarCodeUnique $barCodeUniqueSpec
    ) {
        $this->emailService = $emailService;
        $this->barCodeUniqueSpec = $barCodeUniqueSpec;
    }

    /**
     * @param NewDocumentCommand $command
     * @return ICommandResult
     */
    public function handle(ICommand $command): ICommandResult
    {

        $status = StatusIdFactory::create();
        $document = DocumentFactory::create($status, $command->dueDate, $command->barCode);

        if (!$document->isValid()) {
            return new CommandResult(false, 'Algumas incosistências foram identificadas', $document->fetchErrors());
        }

        if (!$this->barCodeUniqueSpec->isSatisfiedBy($document->getBarCode())) {
            return new CommandResult(false, 'O código de barras informado já existe', $command->asArray());
        }

        $this->emailService->send('emailto@picpay.com', "bills@picpay.com", "Bem vindo",
            "Boleto registrado com sucesso!!");

        return new CommandResult(true, 'Boleto registrado com sucesso!!', [
            'status' => $document->getStatusId()
                ->value(),
            'dueDate' => $document->getDueDate()
        ]);

    }

}