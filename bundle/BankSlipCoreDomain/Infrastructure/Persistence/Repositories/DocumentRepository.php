<?php

namespace BankSlipCoreDomain\Infrastructure\Persistence\Repositories;

use BankSlipCoreDomain\Model\Document\Entities\Document;
use BankSlipCoreDomain\Model\Document\Repositories\IDocumentRepository;

class DocumentRepository implements IDocumentRepository
{

    private $model;

    public function countFor($document): int
    {
        return count($document->getBarCode());
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function create(Document $input): void
    {
        //$this->model->create($input);
    }

}