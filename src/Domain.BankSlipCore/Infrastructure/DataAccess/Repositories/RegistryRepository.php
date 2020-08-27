<?php

namespace DomainBankSlipCore\Infrastructure\Persistence\Repositories;

use DomainBankSlipCore\Model\Enroll\Entities\Enroll;
use DomainBankSlipCore\Model\Enroll\Repositories\IEnrollRepository;

class EnrollRepository implements IEnrollRepository
{

    private $model;

    public function countFor($enroll): int
    {
        return count($enroll);
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function create(Enroll $input): void
    {
        //$this->model->create($input);
    }

}