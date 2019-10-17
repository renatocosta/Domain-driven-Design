<?php

namespace BankSlip\Model\Document\Specification;

use BankSlip\Model\Document\Repositories\IDocumentRepository;
use SharedKernel\Model\Specification\CompositeSpecification;

final class BarCodeUnique extends CompositeSpecification
{

    /**
     * @var IDocumentRepository
     */
    private $billsRepository;

    public function __construct(IDocumentRepository $billsRepository)
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