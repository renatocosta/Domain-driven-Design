<?php

namespace BankSlipCoreDomain\Model\Document\Specification;

interface IBarcodePolicy
{

    /**
     * @return bool
     */
    public function isValidParts(): bool;

}