<?php

namespace Bills\Model\Bill\Repositories;

use Bills\Model\Bill\Entities\Document;

interface IBillsRepository
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