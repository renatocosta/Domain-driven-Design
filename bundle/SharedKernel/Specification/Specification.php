<?php

namespace SharedKernel\Specification;

interface Specification
{

    /**
     * @param mixed $object
     * @return bool
     */
    public function isSatisfiedBy($object): bool;

    /**
     * @param Specification $specification
     * @return Specification
     */
    public function andSpecification(Specification $specification): Specification;

    /**
     * @param Specification $specification
     * @return Specification
     */
    public function orSpecification(Specification $specification): Specification;

    /**
     * @return Specification
     */
    public function not(): Specification;

}