<?php

namespace BankSlipCore\Domain\Model\Document;

interface Documentable
{

    /**
     * @param StatusId $statusId
     * @param string $dueDate
     * @param string $barCode
     * @return mixed
     */
    public function createFrom(StatusId $statusId, string $dueDate, string $barCode);

    /**
     * @return StatusId
     */
    public function getStatusId(): StatusId;

    /**
     * @return string
     */
    public function getBarCode(): string;

    /**
     * @return string
     */
    public function getDueDate(): string;

    public function checkDueDateLessOrEqualThanNow(): void;

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return array
     */
    public function getErrors(): array;

}