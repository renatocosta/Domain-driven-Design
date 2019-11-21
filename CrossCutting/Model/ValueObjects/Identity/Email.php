<?php

namespace CrossCutting\Model\ValueObjects\Identity;

use Assert\Assertion;

class Email
{

    private $value;

    public function __construct(string $value)
    {
        Assertion::email($value);
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

}