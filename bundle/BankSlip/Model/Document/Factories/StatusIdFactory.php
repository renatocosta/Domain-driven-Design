<?php

namespace BankSlip\Model\Document\Factories;

use BankSlip\Model\Document\Entities\ValueObjects\StatusId;
use BankSlip\Model\Document\Enums\StatusIdEnum;

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