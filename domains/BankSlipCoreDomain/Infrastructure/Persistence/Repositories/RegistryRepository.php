<?php

namespace BankSlipCoreDomain\Infrastructure\Persistence\Repositories;

use BankSlipCoreDomain\Model\Enroll\Entities\Enroll;
use BankSlipCoreDomain\Model\Enroll\Repositories\IEnrollRepository;

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