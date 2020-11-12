<?php

namespace DomainBankSlipCore\Application\EventHandlers\Document;

use BankSlipCore\Domain\Model\Document\IBarcodePolicy;

class OtherBarcodePolicy implements IBarcodePolicy
{

    private $barcodeParts;

    public function __construct(string $barCode)
    {
        $this->barcodeParts = explode(' ', $barCode);
    }

    public function isValidParts(): bool
    {
        return count($this->barcodeParts) === 5;
    }

}