<?php

namespace BankSlipCoreDomain\Model\Document\Entity;

use BankSlipCoreDomain\Model\Document\Entities\Document;
use SharedKernel\Model\Event\AbstractEvent;

class DocumentWasChanged extends AbstractEvent
{

    /**
     * @var Document
     */
    public $document;

    public function __construct(Document $document)
    {
        parent::__construct($document->getId());
        $this->document = $document;
    }

}