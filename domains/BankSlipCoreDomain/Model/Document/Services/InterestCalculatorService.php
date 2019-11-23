<?php

namespace BankSlipCoreDomain\Model\Document\Services;

/**
 * Calculate bank slip interest.
 *
 * @author     Renato Costa
 */
interface InterestCalculatorService
{

    /**
     * @param string $dueDate
     * @return float
     */
    public function calculate(string $dueDate): float;

}