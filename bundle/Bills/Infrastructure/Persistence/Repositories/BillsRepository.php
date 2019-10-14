<?php

namespace Bills\Infrastructure\Persistence\Repositories;

use Bills\Model\Bill\Entities\Document;
use Bills\Model\Bill\Repositories\IBillsRepository;

class BillsRepository implements IBillsRepository
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