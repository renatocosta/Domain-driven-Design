<?php

namespace SharedKernel\Model\ValueObjects\Identity;

use Assert\Assertion;

class Enum
{

    const VALID = 'valid';

    private $value;

    public function __construct(string $value)
    {
        Assertion::inArray($value, $this->validValues());
        $this->value = $value;

    }

    private function validValues(): array
    {
        return [
            self::VALID
        ];
    }

    public function value()
    {
        return $this->value;
    }

}