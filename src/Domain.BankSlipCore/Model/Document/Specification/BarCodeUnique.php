<?php

namespace DomainBankSlipCore\Model\Document\Specification;

use DomainBankSlipCore\Model\Document\Repositories\IDocumentRepository;
use CrossCutting\Domain\Model\Specification\CompositeSpecification;

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