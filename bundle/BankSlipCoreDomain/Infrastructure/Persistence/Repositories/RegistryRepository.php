<?php

namespace BankSlipCoreDomain\Infrastructure\Persistence\Repositories;

use BankSlipCoreDomain\Model\Registry\Entities\Registry;
use BankSlipCoreDomain\Model\Registry\Repositories\IRegistryRepository;

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