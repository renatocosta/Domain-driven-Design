<?php

namespace SharedKernel\ValueObjects\Identity;

abstract class Identifier
{

    public $id;

    /**
     * Tells whether two Identity are equal by comparing their values
     *
     * @param Identifier $identifier
     * @return bool
     */
    public function equals(Identifier $identifier): bool
    {
        return $this->id === $identifier->id;
    }

    abstract public function __toString(): string;

}