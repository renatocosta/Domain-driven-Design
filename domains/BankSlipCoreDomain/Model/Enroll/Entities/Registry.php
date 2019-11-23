<?php

namespace BankSlipCoreDomain\Model\Enroll\Entities;

use BankSlipCoreDomain\Model\Document\Entities\Document;
use BankSlipCoreDomain\Model\Enroll\Entities\ValueObjects\StatusId;
use BankSlipCoreDomain\Model\Enroll\Entity\EnrollWasCreated;
use CrossCutting\Domain\Model\Event\ValueObjects\AggregateRoot;
use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;

class Enroll extends AggregateRoot
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
            new EnrollWasCreated($this)
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