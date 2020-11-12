<?php

namespace DomainBankSlipCore\Model\Enroll\Entities;

use DomainBankSlipCore\Model\Document\Entities\DocumentFake;
use DomainBankSlipCore\Model\Enroll\Entities\ValueObjects\StatusId;
use DomainBankSlipCore\Model\Enroll\Entity\EnrollWasCreated;
use CrossCutting\Domain\Model\Event\ValueObjects\AggregateRoot;
use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;

class Enroll extends AggregateRoot
{

    /**
     * @var StatusId
     */
    private $statusId;

    /**
     * @var DocumentFake
     */
    private $document;

    public function __construct(Identified $aggregateRootIdentifier)
    {
        parent::__construct($aggregateRootIdentifier);
    }

    public function create(StatusId $statusId, DocumentFake $document)
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