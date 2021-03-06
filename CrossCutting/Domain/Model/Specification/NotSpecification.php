<?php

namespace CrossCutting\Domain\Model\Specification;

class NotSpecification extends CompositeSpecification
{

    /**
     * @var Specification
     */
    private $specification;

    /**
     * @param Specification $specification
     */
    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    /**
     * @param mixed $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool
    {
        return !$this->specification->isSatisfiedBy($object);
    }

}