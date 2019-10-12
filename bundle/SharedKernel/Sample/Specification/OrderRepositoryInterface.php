<?php

namespace SharedKernel\Sample\Specification;

interface OrderRepositoryInterface
{

    public function countForInvoice(Customer $customer): int;

    public function getRating(Customer $customer): int;
}