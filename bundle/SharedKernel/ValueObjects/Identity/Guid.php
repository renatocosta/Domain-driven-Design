<?php

namespace SharedKernel\ValueObjects\Identity;

use Assert\Assertion;

final class Guid extends Identifier
{

    private function __construct(string $id)
    {
        Assertion::uuid($id);
        $this->id = $id;
    }

    public static function fromString(string $id): Identifier
    {
        return new self($id);
    }

    public function __toString(): string
    {
        return $this->id;
    }

}