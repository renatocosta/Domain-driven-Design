<?php

namespace BankSlip\Infrastructure\Persistence\Repositories;

use BankSlip\Model\Registry\Entities\Registry;
use BankSlip\Model\Registry\Repositories\IRegistryRepository;

class RegistryRepository implements IRegistryRepository
{

    private $model;

    public function countFor($registry): int
    {
        return count($registry);
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function create(Registry $input): void
    {
        //$this->model->create($input);
    }

}