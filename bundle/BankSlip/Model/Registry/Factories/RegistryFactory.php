<?php

namespace BankSlip\Model\Registry\Factories;

use BankSlip\Model\Document\Entities\Document;
use BankSlip\Model\Registry\Entities\Registry;
use BankSlip\Model\Registry\Entities\ValueObjects\StatusId;
use Ramsey\Uuid\Uuid;
use SharedKernel\Model\ValueObjects\Identity\Guid;
use SharedKernel\Model\ValueObjects\Identity\Identified;

class RegistryFactory
{

    public static function create(StatusId $statusId, Document $document): Registry
    {
        $nextIdentity = Guid::fromString(Uuid::uuid4()->toString());
        $registry = new Registry($nextIdentity);
        $registry->create($statusId, $document);
        return $registry;
    }

    public static function createFromAnotherAspcect(Identified $identified): Registry
    {
       // return Registry::creta($identified->getId());
    }

}