<?php

namespace DomainBankSlipCore\Model\Enroll\Factories;

use DomainBankSlipCore\Model\Enroll\Entities\ValueObjects\StatusId;
use DomainBankSlipCore\Model\Enroll\Enums\StatusIdEnum;

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