<?php

namespace BankSlipCoreDomain\Model\Document\Factories;

use BankSlipCoreDomain\Model\Document\Entities\Document;
use BankSlipCoreDomain\Model\Document\Entities\ValueObjects\StatusId;
use BankSlipCoreDomain\Model\Enroll\Entities\Enroll;
use CrossCutting\Domain\Model\ValueObjects\Identity\Guid;
use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;
use Ramsey\Uuid\Uuid;

class DocumentFactory
{

    public static function create(StatusId $statusId, string $dueDate, string $barCode): Document
    {
        $nextIdentity = Guid::fromString(Uuid::uuid4()->toString());
        $document = new Document($nextIdentity);
        $document->create($statusId, $dueDate, $barCode);
        return $document;
    }

    public static function createFromRegister(Identified $identified): Enroll
    {
        // return Enroll::creta($identified->getId());
    }

}