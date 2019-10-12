<?php

namespace SharedKernel\Sample\Specification;

use SharedKernel\Model\Specification\CompositeSpecification;

final class CustomerHasOverdueInvoices extends CompositeSpecification
{

    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Customer $customer
     * @return bool
     */
    public function isSatisfiedBy($customer): bool
    {
        return $this->orderRepository->countForInvoice($customer) > 0;
    }
}