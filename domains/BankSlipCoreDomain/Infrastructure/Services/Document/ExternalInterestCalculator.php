<?php

namespace BankSlipCoreDomain\Infrastructure\Services\Document;

use BankSlipCoreDomain\Model\Document\Services\InterestCalculator;

class ExternalInterestCalculator implements InterestCalculator
{

    public function calculate(string $dueDate): float
    {
        // TODO: Implement calculate() method.
    }

}