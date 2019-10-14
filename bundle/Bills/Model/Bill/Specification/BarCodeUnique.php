<?php

namespace Bills\Model\Bill\Specification;

use Bills\Model\Bill\Repositories\IBillsRepository;
use SharedKernel\Model\Specification\CompositeSpecification;

final class BarCodeUnique extends CompositeSpecification
{

    /**
     * @var IBillsRepository
     */
    private $billsRepository;

    public function __construct(IBillsRepository $billsRepository)
    {
        $this->billsRepository = $billsRepository;
    }

    /**
     * @param string $barCode
     * @return bool
     */
    public function isSatisfiedBy($barCode): bool
    {
        return $this->billsRepository->countFor($barCode) === 0;
    }
}