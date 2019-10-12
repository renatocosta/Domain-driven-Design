<?php

namespace SharedKernel\Specification;

abstract class CompositeSpecification implements Specification
{

    public abstract function isSatisfiedBy($object): bool;

    public function andSpecification(Specification $specification): Specification
    {
        return new AndSpecification($this, $specification);
    }

    public function orSpecification(Specification $specification): Specification
    {
        return new OrSpecification($this, $specification);
    }

    public function not(): Specification
    {
        return new NotSpecification($this);
    }

}