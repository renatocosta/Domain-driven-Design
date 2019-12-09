<?php

namespace BankSlipCoreDomain\Model\Document\Specification;

/**
 * Interface it is for create a specification that is able to tell if a incoming data matches some criteria.
 *
 */
interface IBarcodePolicy
{

    /**
     * @return bool
     */
    public function isValidParts(): bool;

}