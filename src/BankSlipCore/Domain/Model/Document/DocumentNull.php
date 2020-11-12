<?php

namespace BankSlipCore\Domain\Model\Document;

class DocumentNull implements Documentable
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

    public function getStatusId(): StatusId
    {
        $anythingStatus = StatusIdEnum::STATUS_SCHEDULED;
        return new StatusId($anythingStatus);
    }

    public function getBarCode(): string
    {
        return null;
    }

    public function getDueDate(): string
    {
        return null;
    }

    public function getErrors(): array
    {
        return [];
    }

}