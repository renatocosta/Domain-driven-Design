<?php

namespace CrossCutting\Domain\Application\CommandHandlers\Commands\Outputs;

class CommandResult implements ICommandResult
{

    private $success;

    private $message;

    private $data;

    public function __construct(bool $success, string $message, array $data)
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

    public function success(): bool
    {
        return $this->success;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function data(): array
    {
        return $this->data;
    }

}