<?php

namespace DomainBankSlipCore\Infrastructure\Document;

use DomainBankSlipCore\Model\Document\Services\InterestCalculator;

class ExternalInterestCalculatorFake implements InterestCalculator
{

    public function calculate(string $dueDate): float
    {
        // TODO: Implement calculate() method.
    }

}