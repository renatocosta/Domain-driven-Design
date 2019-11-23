<?php

namespace CrossCutting\Domain\Application\CommandHandlers;

use BankSlipCoreDomain\Infrastructure\Transaction\UnitOfWorkContext;
use CrossCutting\Domain\Application\CommandHandlers\Commands\Inputs\ICommand;
use CrossCutting\Domain\Application\CommandHandlers\Commands\Outputs\ICommandResult;
use CrossCutting\Domain\Infrastructure\IUnitOfWorkContext;

class TransactionalHandler implements ICommandHandler
{

    /**
     * @var ICommandHandler
     */
    private $commandHandler;

    /**
     * @var UnitOfWorkContext
     */
    private $unitOfWork;

    public function __construct(ICommandHandler $commandHandler, IUnitOfWorkContext $unitOfWorkContext)
    {
        $this->commandHandler = $commandHandler;
        $this->unitOfWork = $unitOfWorkContext;
        $this->unitOfWork->beginTransaction();
    }

    public function handle(ICommand $command): ICommandResult
    {
        $result = $this->commandHandler->handle($command);

        if ($result->success()) {
            $this->unitOfWork->commit();
        }

        return $result;

    }

}