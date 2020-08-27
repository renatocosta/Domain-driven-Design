<?php

namespace DomainBankSlipCore\Infrastructure\DataAccess\Repositories;

use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;
use DomainBankSlipCore\Model\Document\Entities\Documentable;
use DomainBankSlipCore\Model\Document\Entities\IDocumentFactory;
use DomainBankSlipCore\Model\Document\Entities\ValueObjects\StatusId;
use DomainBankSlipCore\Model\Document\Repositories\IDocumentRepository;

class DocumentRepositoryFake implements IDocumentRepository
{

    private $model;

    /**
     * @var IDocumentFactory
     */
    private $documentFactory;

    public function __construct($model, IDocumentFactory $documentFactory)
    {
        $this->model = $model;
        $this->documentFactory = $documentFactory;
    }

    public function countFor(array $identifiers): int
    {
        $numberAffectedRows = $this->model->findIn($identifiers)->count();
        return $numberAffectedRows;
    }

    public function find(Identified $identify): Documentable
    {

        $affectedRows = $this->model->find($identify);
        $numberOfAffectedRows = $affectedRows->count();

        if ($numberOfAffectedRows === 0) {
            return $this->documentFactory->newNullDocument();
        }

        if ($numberOfAffectedRows > 1) {
            throw new \LengthException("The record must be unique");
        }

        $document = $this->documentFactory->newDocument();
        $document->createFrom(new StatusId($affectedRows->statusId), $affectedRows->dueDate, $affectedRows->barCode);

        return $document;

    }

    public function create(Documentable $document): void
    {
        $this->model->insert([
            'status' => $document->getStatusId(),
            'dueDate' => $document->getDueDate(),
            'barCode' => $document->getBarCode()
        ]);
    }

}
