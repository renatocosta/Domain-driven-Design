<?php

namespace DomainBankSlipCore\Model\Document\Repositories;

use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;
use DomainBankSlipCore\Model\Document\Entities\Documentable;

interface IDocumentRepository
{

    /**
     * @param Identified[]
     * @return int
     */
    public function countFor(array $identifiers): int;

    /**
     * @param Identified $identifyId
     * @return Documentable
     */
    public function find(Identified $identifyId): Documentable;

    /**
     * @param Documentable $document
     */
    public function create(Documentable $document): void;

}