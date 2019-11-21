<?php

namespace CrossCutting\Application\CommandHandlers;

use CrossCutting\Application\CommandHandlers\Commands\Inputs\ICommand;
use CrossCutting\Application\CommandHandlers\Commands\Outputs\ICommandResult;

interface ICommandHandler
{
    /**
     * @param ICommand $command
     * @return ICommandResult
     */
    public function handle(ICommand $command): ICommandResult;
}