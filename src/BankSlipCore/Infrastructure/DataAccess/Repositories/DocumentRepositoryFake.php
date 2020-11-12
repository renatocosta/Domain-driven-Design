<?php

namespace DomainBankSlipCore\Infrastructure\DataAccess\Repositories;

use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;
use DomainBankSlipCore\Model\Document\Entities\Documentable;
use DomainBankSlipCore\Model\Document\Entities\IDocumentFactory;
use DomainBankSlipCore\Model\Document\Entities\ValueObjects\StatusId;
use DomainBankSlipCore\Model\Document\Repositories\IDocumentRepository;

class DocumentRepositoryFake implements IDocumentRepository
{


    public function countFor(array $identifiers): int
    {
        $numberAffectedRows = count($identifiers);
        return $numberAffectedRows;
    }

    public function find(Identified $identify): Documentable
    {

        $document = $this->documentFactory->newFakeDocument();
        $document->createFrom(new StatusId('S'), '2020-10-01', '96789879119781789179');

        return $document;

    }

    public function create(Documentable $document): void
    {
        /*$this->model->insert([
            'status' => $document->getStatusId(),
            'dueDate' => $document->getDueDate(),
            'barCode' => $document->getBarCode()
        ]);*/
    }

}
