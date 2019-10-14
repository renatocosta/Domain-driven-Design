<?php

namespace Bills\Model\Bill\Entities;

use Assert\Assert;
use Assert\AssertionFailedException;
use Bills\Model\Bill\Entities\ValueObjects\StatusId;
use SharedKernel\Model\Event\ValueObjects\AggregateRoot;
use SharedKernel\Model\ValueObjects\Identity\Identified;
use SharedKernel\Sample\Entity\DocumentWasCreated;

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
     * @var array
     */
    private $errors;

    public function __construct(Identified $aggregateRootIdentifier)
    {
        parent::__construct($aggregateRootIdentifier);
    }

    public function create(StatusId $statusId, string $dueDate, string $barCode): Document
    {
        $this->statusId = $statusId;

        try {
            Assert::that($dueDate, 'Due Date can not be empty')->notBlank();
            Assert::that($barCode, 'Bar code can not be empty')->notBlank();
            $this->dueDate = $dueDate;
            $this->barCode = $barCode;
        } catch(AssertionFailedException $e) {
            $this->errors[] = $e->getMessage();
        }
        $this->isDueDateLessOrEqualThanNow();

        $this->apply(
            new DocumentWasCreated($this->getId())
        );

        return $this;

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

    private function isDueDateLessOrEqualThanNow(): bool
    {
        if($this->dueDate <= date('Y-m-d')) {
            $this->errors[] = 'Due Date must be greater than now!';
            return false;
        }

        return true;

    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function fetchErrors(): array
    {
        return $this->errors;
    }

}