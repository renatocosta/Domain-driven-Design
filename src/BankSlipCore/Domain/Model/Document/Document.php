<?php

namespace BankSlipCore\Domain\Model\Document;

use Assert\Assert;
use Assert\AssertionFailedException;
use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use CrossCutting\Domain\Model\Event\ValueObjects\AggregateRoot;
use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;

class Document extends AggregateRoot implements Documentable
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
     * @var array
     */
    private $errors = [];

    public function __construct(Identified $aggregateRootIdentifier, DomainEventBus $domainEventBus)
    {
        parent::__construct($aggregateRootIdentifier, $domainEventBus);
    }

    public function createFrom(StatusId $statusId, string $dueDate, string $barCode)
    {
        $this->statusId = $statusId;
        $this->dueDate = $dueDate;
        $this->barCode = $barCode;

        try {
            Assert::that($this->dueDate, 'Due Date can not be empty')->notBlank();
            Assert::that($this->dueDate, 'Due Date invalid format')->date('Y-m-d');
            Assert::that($this->barCode, 'Bar code can not be empty')->notBlank();
        } catch (AssertionFailedException $e) {
            $this->errors[] = $e->getMessage();
        }

        $this->checkDueDateLessOrEqualThanNow();

        if (!$this->isValid()) {
            return;
        }

        $this->apply(
            new DocumentWasCreated($this)
        );
    }

    public function checkDueDateLessOrEqualThanNow(): void
    {

        if (strtotime($this->dueDate) <= strtotime(date('Y-m-d'))) {
            $this->errors[] = 'Due Date must be greater than now!';
        }

    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    public function getStatusId(): StatusId
    {
        return $this->statusId;
    }

    public function getBarCode(): string
    {
        return $this->barCode;
    }

    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}