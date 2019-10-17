<?php

namespace BankSlip\Model\Registry\Repositories;

use BankSlip\Model\Registry\Entities\Registry;

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