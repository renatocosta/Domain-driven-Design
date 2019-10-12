<?php

namespace SharedKernel\Sample\Specification;

interface CustomerSpecification
{
    /**
     * @param Customer $customer
     * @return bool
     */
    public function isSatisfiedBy(Customer $customer): bool;
}