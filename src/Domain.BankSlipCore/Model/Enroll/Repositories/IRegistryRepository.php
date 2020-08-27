<?php

namespace DomainBankSlipCore\Model\Enroll\Repositories;

use DomainBankSlipCore\Model\Enroll\Entities\Enroll;

interface IEnrollRepository
{

    /**
     * @param $enroll
     * @return int
     */
    public function countFor($enroll): int;

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param Enroll $input
     */
    public function create(Enroll $input): void;

}