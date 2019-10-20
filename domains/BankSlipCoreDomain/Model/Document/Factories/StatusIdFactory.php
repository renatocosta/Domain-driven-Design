<?php

namespace BankSlipCoreDomain\Model\Document\Factories;

use BankSlipCoreDomain\Model\Document\Entities\ValueObjects\StatusId;
use BankSlipCoreDomain\Model\Document\Enums\StatusIdEnum;

class StatusIdFactory
{

    public static function create(): StatusId
    {
        return new StatusId(StatusIdEnum::STATUS_SCHEDULED);
    }

    public static function createFromLiquidated(): StatusId
    {
        return new StatusId(StatusIdEnum::STATUS_LIQUIDATED);
    }

}