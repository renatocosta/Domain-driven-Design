<?php

namespace SharedKernel\Model\Commands;

interface ICommandResult
{

    public function success(): bool;

    public function message(): string;

    public function data(): array;

}