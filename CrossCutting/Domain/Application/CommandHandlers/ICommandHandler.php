<?php

namespace CrossCutting\Domain\Application\CommandHandlers;

use CrossCutting\Domain\Application\CommandHandlers\Commands\Inputs\ICommand;
use CrossCutting\Domain\Application\CommandHandlers\Commands\Outputs\ICommandResult;

interface ICommandHandler
{
    /**
     * @param ICommand $command
     * @return ICommandResult
     */
    public function handle(ICommand $command): ICommandResult;
}