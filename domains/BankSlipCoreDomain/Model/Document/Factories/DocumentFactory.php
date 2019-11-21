<?php

namespace BankSlipCoreDomain\Model\Document\Factories;

use BankSlipCoreDomain\Model\Document\Entities\Document;
use BankSlipCoreDomain\Model\Document\Entities\ValueObjects\StatusId;
use Ramsey\Uuid\Uuid;
use CrossCutting\Model\ValueObjects\Identity\Guid;
use CrossCutting\Model\ValueObjects\Identity\Identified;

class DocumentFactory
{

    public static function create(StatusId $statusId, string $dueDate, string $barCode): Document
    {
        $nextIdentity = Guid::fromString(Uuid::uuid4()->toString());
        $document = new Document($nextIdentity);
        $document->create($statusId, $dueDate, $barCode);
        return $document;
    }

    public static function createFromWithRegister(Identified $identified): Enroll
    {
       // return Enroll::creta($identified->getId());
    }

}