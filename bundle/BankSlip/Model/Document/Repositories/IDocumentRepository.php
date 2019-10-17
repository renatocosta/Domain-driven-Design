<?php

namespace BankSlip\Model\Document\Repositories;

use BankSlip\Model\Document\Entities\Document;
use BankSlip\Model\Document\Entities\Registry;

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