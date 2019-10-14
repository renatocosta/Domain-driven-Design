<?php

namespace Bills\Model\Bill\Repositories;

use Bills\Model\Bill\Entities\Document;

interface IBillsRepository
{

    public function countFor($document): int;

    public function getAll(): array;

    public function create(Document $input): void;

}