<?php

namespace DomainBankSlipCore\Infrastructure\DataAccess\Repositories;

use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;
use DomainBankSlipCore\Model\Document\Entities\Documentable;
use DomainBankSlipCore\Model\Document\Repositories\IDocumentRepository;

class DocumentRepositoryInMemory implements IDocumentRepository
{

    private $repository;


    private $cache;

    public function __construct(IDocumentRepository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function countFor(array $identifiers): int
    {
        return $this->cache->tags('count_documents')->remember($identifiers, 60, function () use($identifiers) {
            $numberOfAffectedRows = $this->model->findIn($identifiers)->count();
            return $numberOfAffectedRows;
        });
    }

    public function find(Identified $identify): Documentable
    {

        return $this->cache->tags('documents')->remember($identify, 60, function () use($identify) {
            $document = $this->repository->find($identify);
            return $document;
        });

    }

    public function create(Documentable $document): void
    {
        $this->cache->tags('document')->flush();
        $this->repository->create($document);
    }

}
