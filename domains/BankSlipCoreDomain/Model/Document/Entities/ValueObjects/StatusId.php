<?php

namespace BankSlipCoreDomain\Model\Document\Entities\ValueObjects;

use BankSlipCoreDomain\Model\Document\Enums\StatusIdEnum;
use CrossCutting\Domain\Model\ValueObjects\Identity\FindValueIn;

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