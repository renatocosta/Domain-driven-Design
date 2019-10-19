<?php

namespace BankSlipCoreDomain\Model\Document\Commands\Inputs;

use Assert\Assert;
use Assert\AssertionFailedException;
use SharedKernel\Model\Commands\ICommand;

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