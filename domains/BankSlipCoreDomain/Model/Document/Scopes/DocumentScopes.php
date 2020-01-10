<?php

namespace BankSlipCoreDomain\Model\Document\Scopes;

use Assert\Assert;
use Assert\AssertionFailedException;
use BankSlipCoreDomain\Model\Document\Entities\Document;

final class DocumentScopes
{

    /**
     * @var array
     */
    private $errors;

    public function isScopeValid(Document $document): bool
    {

        $this->errors = [];

        try {
            Assert::that($document->getDueDate(), 'Due Date can not be empty')->notBlank();
            Assert::that($document->getDueDate(), 'Due Date invalid format')->date('Y-m-d');
            Assert::that($document->getBarCode(), 'Bar code can not be empty')->notBlank();
        } catch (AssertionFailedException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }

        return true;

    }

    public function thereWasAnyErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function fetchErrors(): array
    {
        return $this->errors;
    }

}