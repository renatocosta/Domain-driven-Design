<?php

namespace DomainBankSlipCore\Infrastructure\DataAccess\Repositories;

use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;
use DomainBankSlipCore\Model\Document\Entities\Documentable;
use DomainBankSlipCore\Model\Document\Entities\IDocumentFactory;
use DomainBankSlipCore\Model\Document\Repositories\IDocumentRepository;

class DocumentRepositoryInMemory implements IDocumentRepository
{

    private $repository;

    /**
     * @var IDocumentFactory
     */
    private $documentFactory;

    private $cache;

    public function __construct(IDocumentRepository $repository, IDocumentFactory $documentFactory, Cache $cache)
    {
        $this->repository = $repository;
        $this->documentFactory = $documentFactory;
        $this->cache = $cache;
    }

    public function countFor(array $identifiers): int
    {
        return $this->cache->tags('count_documents')->remember($identifiers, 60, function () use($identifiers) {
            $numberAffectedRows = $this->model->findIn($identifiers)->count();
            return $numberAffectedRows;
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
