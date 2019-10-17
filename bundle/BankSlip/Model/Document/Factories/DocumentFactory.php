<?php

namespace BankSlip\Model\Document\Factories;

use BankSlip\Model\Document\Entities\Document;
use BankSlip\Model\Document\Entities\ValueObjects\StatusId;
use Ramsey\Uuid\Uuid;
use SharedKernel\Model\ValueObjects\Identity\Guid;
use SharedKernel\Model\ValueObjects\Identity\Identified;

class DocumentFactory
{

    public static function create(StatusId $statusId, string $dueDate, string $barCode): Document
    {
        $nextIdentity = Guid::fromString(Uuid::uuid4()->toString());
        $document = new Document($nextIdentity);
        $document->create($statusId, $dueDate, $barCode);
        return $document;
    }

    public static function createFromWithRegister(Identified $identified): Registry
    {
       // return Registry::creta($identified->getId());
    }

}