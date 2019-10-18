<?php

namespace BankSlipCoreDomain\Model\Registry\Factories;

use BankSlipCoreDomain\Model\Registry\Entities\ValueObjects\StatusId;
use BankSlipCoreDomain\Model\Registry\Enums\StatusIdEnum;

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