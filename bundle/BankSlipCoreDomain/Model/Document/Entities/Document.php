<?php

namespace BankSlipCoreDomain\Model\Document\Entities;

use BankSlipCoreDomain\Model\Document\Entities\ValueObjects\StatusId;
use BankSlipCoreDomain\Model\Document\Scopes\DocumentScopes;
use BankSlipCoreDomain\Model\Document\Entity\DocumentWasCreated;
use SharedKernel\Model\Event\ValueObjects\AggregateRoot;
use SharedKernel\Model\ValueObjects\Identity\Identified;

class Document extends AggregateRoot
{

    /**
     * @var StatusId
     */
    private $statusId;

    /**
     * @var string
     */
    private $dueDate;

    /**
     * @var string
     */
    private $barCode;

    /**
     * @var DocumentScopes
     */
    private $scope;

    /**
     * @var array
     */
    private $errors;

    public function __construct(Identified $aggregateRootIdentifier)
    {
        parent::__construct($aggregateRootIdentifier);
    }

    public function create(StatusId $statusId, string $dueDate, string $barCode)
    {
        $this->statusId = $statusId;
        $this->dueDate = $dueDate;
        $this->barCode = $barCode;

        $this->scope = new DocumentScopes();
        $this->scope->createScopeIsValid($this);
        $this->checkDueDateLessOrEqualThanNow();

        if (!$this->isValid()) {
           return;
        }

        $this->apply(
            new DocumentWasCreated($this)
        );

    }

    public function getStatusId(): StatusId
    {
        return $this->statusId;
    }

    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    public function getBarCode(): string
    {
        return $this->barCode;
    }

    private function checkDueDateLessOrEqualThanNow(): void
    {
        if(strtotime($this->dueDate) <= strtotime(date('Y-m-d'))) {
            $this->errors[] = 'Due Date must be greater than now!';
        }

    }

    public function isValid(): bool
    {
        $isValid = !$this->scope->anyError() && count($this->errors) === 0;

        return $isValid;
    }

    public function fetchErrors(): array
    {
        return array_merge($this->errors, $this->scope->fetchErrors());
    }

}