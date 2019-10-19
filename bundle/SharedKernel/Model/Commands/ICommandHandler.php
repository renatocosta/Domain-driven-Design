<?php

namespace SharedKernel\Model\Commands;

interface ICommandHandler
{
    /**
     * @param ICommand $command
     * @return ICommandResult
     */
    public function handle(ICommand $command): ICommandResult;
}