<?php

namespace DomainBankSlipCore\Infrastructure\DataAccess\Entities;

use DomainBankSlipCore\Model\Document\Entities\Documentable;
use DomainBankSlipCore\Model\Document\Entities\ValueObjects\StatusId;
use DomainBankSlipCore\Model\Document\Enums\StatusIdEnum;

class DocumentFake implements Documentable
{

    public function createFrom(StatusId $statusId, string $dueDate, string $barCode)
    {
        throw new \RuntimeException("Can not be called here!");
    }

    public function checkDueDateLessOrEqualThanNow(): void
    {
        throw new \RuntimeException("Can not be called here!");
    }

    public function isValid(): bool
    {
        return false;
    }

    /**
     * @return StatusId
     */
    public function getStatusId(): StatusId
    {
        $anyStatus = StatusIdEnum::STATUS_SCHEDULED;
        return new StatusId($anyStatus);
    }

    /**
     * @return string
     */
    public function getBarCode(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return null;
    }

    public function getErrors(): array
    {
        return [];
    }

}