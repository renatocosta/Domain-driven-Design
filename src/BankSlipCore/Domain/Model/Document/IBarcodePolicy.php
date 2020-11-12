<?php

namespace BankSlipCore\Domain\Model\Document;

/**
 * Providing a specification that tells whether an incoming data matches with some criteria given.
 *
 */
interface IBarcodePolicy
{

    /**
     * @return bool
     */
    public function isValidParts(): bool;

}