<?php

namespace SharedKernel\Sample\Specification;

class OrderRepository implements OrderRepositoryInterface
{

    public function countForInvoice(Customer $customer): int
    {
        return count($customer->getOverDueInvoices());
    }

    public function getRating(Customer $customer): int
    {
        return $customer->getStarRatings();
    }
}