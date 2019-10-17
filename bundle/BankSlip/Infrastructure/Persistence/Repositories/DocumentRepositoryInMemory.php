<?php

namespace BankSlip\Infrastructure\Persistence\Repositories;

use BankSlip\Model\Document\Entities\Document;
use BankSlip\Model\Document\Repositories\IDocumentRepository;

class DocumentRepositoryInMemory implements IDocumentRepository
{

    protected $repository;

    protected $cache;

    public function __construct(IDocumentRepository $repository, Cache $cache)
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