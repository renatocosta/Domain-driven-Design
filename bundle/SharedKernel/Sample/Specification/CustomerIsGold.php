<?php

namespace SharedKernel\Sample\Specification;

use SharedKernel\Specification\CompositeSpecification;

final class CustomerIsGold extends CompositeSpecification
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
        return $this->orderRepository->getRating($customer) > 3;
    }
}