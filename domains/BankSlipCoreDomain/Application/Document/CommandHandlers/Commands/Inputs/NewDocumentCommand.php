<?php

namespace BankSlipCoreDomain\Application\Document\CommandHandlers\Commands\Inputs;

use CrossCutting\Domain\Application\CommandHandlers\Commands\Inputs\ICommand;

class NewDocumentCommand implements ICommand
{

    /**
     * @var string
     */
    public $barCode;

    /**
     * @var string
     */
    public $dueDate;

    public function __construct(string $barCode, string $dueDate)
    {
       $this->barCode = $barCode;
       $this->dueDate = $dueDate;
    }

    public function asArray(): array
    {
        return [
            'dueDate'  => $this->dueDate,
            'barCode'  => $this->barCode
        ];
    }

}