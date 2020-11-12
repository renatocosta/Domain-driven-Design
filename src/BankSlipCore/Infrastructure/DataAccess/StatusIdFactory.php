<?php

namespace DomainBankSlipCore\Infrastructure\DataAccess;

use DomainBankSlipCore\Model\Document\Entities\ValueObjects\StatusId;
use DomainBankSlipCore\Model\Document\Enums\StatusIdEnum;

class StatusIdFactory
{

    public static function create(): StatusId
    {
        return new StatusId(StatusIdEnum::STATUS_SCHEDULED);
    }

    public static function createOfLiquidated(): StatusId
    {
        return new StatusId(StatusIdEnum::STATUS_LIQUIDATED);
    }

}