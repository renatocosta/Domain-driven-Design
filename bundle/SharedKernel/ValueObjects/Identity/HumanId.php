<?php

namespace SharedKernel\ValueObjects\Identity;

final class HumanId extends Identifier
{

    private $id;

    private function __construct(int $id)
    {
        $this->id = $id;
    }

    public static function fromInteger(int $id): Identifier
    {
        return new self($id);
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

}