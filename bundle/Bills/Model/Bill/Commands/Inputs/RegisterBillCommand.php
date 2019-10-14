<?php

namespace Bills\Model\Bill\Commands\Inputs;

use Assert\Assert;
use Assert\AssertionFailedException;

class RegisterBillCommand
{

    /**
     * @var string
     */
    private $barCode;

    /**
     * @var string
     */
    private $dueDate;

    public function __construct(string $barCode, string $dueDate)
    {
       $this->barCode = $barCode;
       $this->dueDate = $dueDate;
    }

    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    public function getBarCode(): string
    {
        return $this->barCode;
    }

    public function asArray(): array
    {
        return [
            'dueDate'  => $this->dueDate,
            'barCode'  => $this->barCode
        ];
    }

}