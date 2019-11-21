<?php

namespace BankSlipCoreDomain\Model\Document\Repositories;

use BankSlipCoreDomain\Model\Document\Entities\Document;
use BankSlipCoreDomain\Model\Document\Entities\Enroll;

interface IDocumentRepository
{

    /**
     * @param $document
     * @return int
     */
    public function countFor($document): int;

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param Document $input
     */
    public function create(Document $input): void;

}