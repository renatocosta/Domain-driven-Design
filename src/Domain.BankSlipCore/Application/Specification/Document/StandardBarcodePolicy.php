<?php

namespace DomainBankSlipCore\Application\Document\Specification;

use DomainBankSlipCore\Model\Document\Specification\IBarcodePolicy;

class StandardBarcodePolicy implements IBarcodePolicy
{

    private $barcodeParts;

    public function __construct(string $barCode)
    {
        $this->barcodeParts = explode(' ', $barCode);
    }

    public function isValidParts(): bool
    {
        return count($this->barcodeParts) === 4;
    }

}