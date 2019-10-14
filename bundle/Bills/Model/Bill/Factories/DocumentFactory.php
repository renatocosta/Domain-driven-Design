<?php

namespace Bills\Model\Bill\Factories;

use Bills\Model\Bill\Entities\Document;
use Bills\Model\Bill\Entities\ValueObjects\StatusId;
use Ramsey\Uuid\Uuid;
use SharedKernel\Model\ValueObjects\Identity\Guid;
use SharedKernel\Model\ValueObjects\Identity\Identified;
use SharedKernel\Sample\Entity\Entity;

class DocumentFactory
{

    public static function create(StatusId $statusId, string $dueDate, string $barCode): Document
    {
        $document = new Document(Guid::fromString(Uuid::uuid4()->toString()));
        $document->create($statusId, $dueDate, $barCode);
        return $document;
    }

    public static function createFromWithRegister(Identified $identified): Document
    {
       // return Document::creta($identified->getId());
    }

}