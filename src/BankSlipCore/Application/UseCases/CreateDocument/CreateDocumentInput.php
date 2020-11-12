<?php

namespace DomainBankSlipCore\Application\UseCases\Document\CreateDocument;

use Assert\AssertionFailedException;
use DomainBankSlipCore\Application\Services\Common\Notification;
use DomainBankSlipCore\Model\Document\Entities\ValueObjects\StatusId;
use DomainBankSlipCore\Model\Document\Enums\StatusIdEnum;

class CreateDocumentInput
{

    public $modelState;

    public $statusId;

    public $dueDate;

    public $barCode;

    public function __construct(string $statusId, string $dueDate, string $barCode)
    {

        $this->modelState = new Notification();

        try {
            $this->statusId = new StatusId($statusId);
        } catch (AssertionFailedException $e) {
            $this->modelState->add('status_id', sprintf('%s Does not match with the following statuses %s.', $statusId,
                implode(', ', StatusIdEnum::STATUS)));
        }

        if(!empty($dueDate)) {
            $this->dueDate = $dueDate;
        } else {
            $this->modelState->add('due_date', 'Due date is required.');
        }

        if(!empty($barCode)) {
            $this->barCode = $barCode;
        } else {
            $this->modelState->add('bar_code', 'Bar code is required.');
        }

    }

}