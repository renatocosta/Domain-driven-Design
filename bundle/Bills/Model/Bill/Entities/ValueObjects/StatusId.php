<?php

namespace Bills\Model\Bill\Entities\ValueObjects;

use Bills\Model\Bill\Enums\StatusIdEnum;
use SharedKernel\Model\ValueObjects\Identity\FindValueIn;

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