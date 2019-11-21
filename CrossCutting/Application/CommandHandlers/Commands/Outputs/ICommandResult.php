<?php

namespace CrossCutting\Application\CommandHandlers\Commands\Outputs;

interface ICommandResult
{

    public function success(): bool;

    public function message(): string;

    public function data(): array;

}