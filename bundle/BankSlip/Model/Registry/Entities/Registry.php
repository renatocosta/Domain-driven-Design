<?php

namespace BankSlip\Model\Registry\Entities;

use BankSlip\Model\Document\Entities\Document;
use BankSlip\Model\Registry\Entities\ValueObjects\StatusId;
use BankSlip\Model\Registry\Entity\RegistryWasCreated;
use SharedKernel\Model\Event\ValueObjects\AggregateRoot;
use SharedKernel\Model\ValueObjects\Identity\Identified;

class Registry extends AggregateRoot
{

    /**
     * @var StatusId
     */
    private $statusId;

    /**
     * @var Document
     */
    private $document;

    public function __construct(Identified $aggregateRootIdentifier)
    {
        parent::__construct($aggregateRootIdentifier);
    }

    public function create(StatusId $statusId, Document $document)
    {
        $this->statusId = $statusId;
        $this->document = $document;

        $this->apply(
            new RegistryWasCreated($this)
        );

    }

    public function getStatusId(): StatusId
    {
        return $this->statusId;
    }

    public function getSlipId(): int
    {
        return $this->document->getId();
    }
}