<?php

namespace Bills\Infrastructure\Persistence\Repositories;

use Bills\Model\Bill\Entities\Document;
use Bills\Model\Bill\Repositories\IBillsRepository;

class BillsRepositoryInMemory implements IBillsRepository
{

    protected $repository;

    protected $cache;

    public function __construct(IBillsRepository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function create(Document $input): void
    {
        $this->cache->tags('bills')->flush();
        $this->repository->create($input);
    }

    public function countFor($bill): int
    {
        return $this->cache->tags('count_bills')->remember($bill, 60, function () use ($bill) {
            return count($bill->getDueDate());
        });
    }

    public function getAll(): array
    {
        return [];
    }
}