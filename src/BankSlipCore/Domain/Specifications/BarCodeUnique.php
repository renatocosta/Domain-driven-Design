<?php

namespace BankSlipCore\Domain\Specifications;

use BankSlipCore\Domain\Model\Document\IDocumentRepository;
use CrossCutting\Domain\Model\Specification\CompositeSpecification;

final class BarCodeUnique extends CompositeSpecification
{

    /**
     * @var IDocumentRepository
     */
    private $documentRepository;

    public function __construct(IDocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    /**
     * @param mixed $barCode
     * @return bool
     */
    public function isSatisfiedBy($barCode): bool
    {
        return $this->documentRepository->countFor([]) === 0;
    }
}