<?php

namespace Bills\Model\Bill\Factories;

use Bills\Model\Bill\Entities\ValueObjects\StatusId;
use Bills\Model\Bill\Enums\StatusIdEnum;
use SharedKernel\Sample\Entity\Entity;

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