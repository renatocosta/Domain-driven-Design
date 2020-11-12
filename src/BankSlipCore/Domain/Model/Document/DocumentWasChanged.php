<?php

namespace BankSlipCore\Domain\Model\Document;

use CrossCutting\Domain\Application\Event\AbstractEvent;

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