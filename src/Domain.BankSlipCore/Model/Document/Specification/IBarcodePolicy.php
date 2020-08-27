<?php

namespace DomainBankSlipCore\Model\Document\Specification;

/**
 * Interface for creating a specification that is able to tells whether an incoming data matches with some criteria given.
 *
 */
interface IBarcodePolicy
{

    /**
     * @return bool
     */
    public function isValidParts(): bool;

}