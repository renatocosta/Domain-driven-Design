<?php

namespace DomainBankSlipCore\Infrastructure\DataAccess;

use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;
use DomainBankSlipCore\Infrastructure\DataAccess\Entities\DocumentFake;
use DomainBankSlipCore\Model\Document\Entities\Document;
use DomainBankSlipCore\Model\Document\Entities\Documentable;
use DomainBankSlipCore\Model\Document\Entities\DocumentNull;
use DomainBankSlipCore\Model\Document\Entities\IDocumentFactory;
use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use CrossCutting\Domain\Model\ValueObjects\Identity\Guid;
use Ramsey\Uuid\Uuid;

class DocumentFactory implements IDocumentFactory
{

    /**
     * @var DomainEventBus
     */
    private $domainEventBus;

    public function __construct(DomainEventBus $domainEventBus)
    {
        $this->domainEventBus = $domainEventBus;
    }

    public function newDocument(): Documentable
    {
        $nextIdentity = Guid::fromString(Uuid::uuid4()->toString());
        $document = new Document($nextIdentity,  $this->domainEventBus);
        return $document;
    }

    public function newFromExisting(Identified $identify): Documentable
    {
        $document = new Document($identify, $this->domainEventBus);
        return $document;
    }

    public function newNullDocument(): Documentable
    {
        $document = new DocumentNull();
        return $document;
    }
}
