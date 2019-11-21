<?php

namespace CrossCutting\Model\ValueObjects\Network;

use Assert\Assertion;

class Url
{

    private $value;

    public function __construct(string $value)
    {
        Assertion::url($value);
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

}