<?php

namespace BankSlip\Model\Registry\Factories;

use BankSlip\Model\Registry\Entities\ValueObjects\StatusId;
use BankSlip\Model\Registry\Enums\StatusIdEnum;

class StatusIdFactory
{

    public static function create(): StatusId
    {
        return new StatusId(StatusIdEnum::STATUS_DEFAULT);
    }

    public static function createFromSuccessfully(): StatusId
    {
        return new StatusId(StatusIdEnum::STATUS_SUCCESS);
    }

}