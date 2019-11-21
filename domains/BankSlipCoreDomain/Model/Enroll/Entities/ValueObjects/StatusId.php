<?php

namespace BankSlipCoreDomain\Model\Enroll\Entities\ValueObjects;

use BankSlipCoreDomain\Model\Enroll\Enums\StatusIdEnum;
use CrossCutting\Model\ValueObjects\Identity\FindValueIn;

class StatusId
{

    private $value;

    public function __construct(string $value)
    {
        $findValueIn = new FindValueIn($value, StatusIdEnum::STATUS);
        $this->value = $findValueIn->value();
    }

    public function value()
    {
        return $this->value;
    }

}