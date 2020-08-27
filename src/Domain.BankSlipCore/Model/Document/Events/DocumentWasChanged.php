<?php

namespace DomainBankSlipCore\Model\Document\Entity;

use DomainBankSlipCore\Model\Document\Entities\DocumentFake;
use CrossCutting\Domain\Application\Event\AbstractEvent;

class DocumentWasChanged extends AbstractEvent
{

    /**
     * @var DocumentFake
     */
    public $document;

    public function __construct(DocumentFake $document)
    {
        parent::__construct($document->getId());
        $this->document = $document;
    }

}