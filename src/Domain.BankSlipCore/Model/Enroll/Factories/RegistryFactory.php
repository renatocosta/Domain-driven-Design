<?php

namespace DomainBankSlipCore\Model\Enroll\Factories;

use DomainBankSlipCore\Model\Document\Entities\DocumentFake;
use DomainBankSlipCore\Model\Enroll\Entities\Enroll;
use DomainBankSlipCore\Model\Enroll\Entities\ValueObjects\StatusId;
use CrossCutting\Domain\Model\ValueObjects\Identity\Guid;
use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;
use Ramsey\Uuid\Uuid;

class EnrollFactory
{

    public static function create(StatusId $statusId, DocumentFake $document): Enroll
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