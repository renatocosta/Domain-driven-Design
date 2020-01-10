<?php

namespace BankSlipCoreDomain\Model\Enroll\Factories;

use BankSlipCoreDomain\Model\Document\Entities\Document;
use BankSlipCoreDomain\Model\Enroll\Entities\Enroll;
use BankSlipCoreDomain\Model\Enroll\Entities\ValueObjects\StatusId;
use CrossCutting\Domain\Model\ValueObjects\Identity\Guid;
use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;
use Ramsey\Uuid\Uuid;

class EnrollFactory
{

    public static function create(StatusId $statusId, Document $document): Enroll
    {
        $nextIdentity = Guid::fromString(Uuid::uuid4()->toString());
        $enroll = new Enroll($nextIdentity);
        $enroll->create($statusId, $document);
        return $enroll;
    }

    public static function createFromAnotherAspcect(Identified $identified): Enroll
    {
        // return Enroll::creta($identified->getId());
    }

}