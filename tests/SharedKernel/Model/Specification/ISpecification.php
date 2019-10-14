<?php

namespace SharedKernel\Model\Specification;

interface ISpecification
{
    /**
     * @param mixed $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool;
}