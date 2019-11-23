<?php

namespace BankSlipCoreDomain\Infrastructure\Services\Document;

use BankSlipCoreDomain\Model\Document\Services\InterestCalculatorService;

class ExternalInterestCalculatorService implements InterestCalculatorService
{

    public function calculate(string $dueDate): float
    {
        // TODO: Implement calculate() method.
    }

}