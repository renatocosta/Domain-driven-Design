<?php

namespace BankSlipCoreDomain\Model\Registry\Repositories;

use BankSlipCoreDomain\Model\Registry\Entities\Registry;

interface IRegistryRepository
{

    /**
     * @param $registry
     * @return int
     */
    public function countFor($registry): int;

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param Registry $input
     */
    public function create(Registry $input): void;

}