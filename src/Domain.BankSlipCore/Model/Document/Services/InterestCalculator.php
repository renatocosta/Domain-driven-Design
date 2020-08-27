<?php

namespace DomainBankSlipCore\Model\Document\Services;

/**
 * Calculate bank slip interest.
 *
 * @author     Renato Costa
 */
interface InterestCalculator
{

    /**
     * @param string $dueDate
     * @return float
     */
    public function calculate(string $dueDate): float;

}