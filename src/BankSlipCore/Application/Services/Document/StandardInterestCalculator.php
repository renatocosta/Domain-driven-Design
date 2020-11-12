<?php

namespace DomainBankSlipCore\Application\Services\Document;

use DomainBankSlipCore\Model\Document\Services\InterestCalculator;

class StandardInterestCalculator implements InterestCalculator
{

    public function calculate(string $dueDate): float
    {
        // TODO: Implement calculate() method.
    }

}