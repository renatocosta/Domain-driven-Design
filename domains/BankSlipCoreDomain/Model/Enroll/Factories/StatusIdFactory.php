<?php

namespace BankSlipCoreDomain\Model\Enroll\Factories;

use BankSlipCoreDomain\Model\Enroll\Entities\ValueObjects\StatusId;
use BankSlipCoreDomain\Model\Enroll\Enums\StatusIdEnum;

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