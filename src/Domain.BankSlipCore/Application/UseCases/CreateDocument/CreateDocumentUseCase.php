<?php

namespace DomainBankSlipCore\Application\UseCases\Document\CreateDocument;

use DomainBankSlipCore\Application\UseCases\CreateDocument\ICreateDocumentUseCase;
use DomainBankSlipCore\Application\UseCases\CreateDocument\IOutputPort;
use DomainBankSlipCore\Model\Document\Entities\Documentable;
use DomainBankSlipCore\Model\Document\Repositories\IDocumentRepository;
use DomainBankSlipCore\Model\Document\Specification\BarCodeUnique;
use CrossCutting\Domain\Infrastructure\Services\IEmailService;

class CreateDocumentUseCase implements ICreateDocumentUseCase
{

    /**
     * @var Documentable
     */
    private $document;

    /**
     * @var IDocumentRepository
     */
    private $documentRepository;

    /**
     * @var IEmailService
     */
    private $emailService;

    /**
     * @var BarCodeUnique
     */
    private $barCodeUniqueSpec;

    /**
     * @var IOutputPort
     */
    private $outputPort;

    public function __construct(
        Documentable $document,
        IDocumentRepository $documentRepository,
        IEmailService $emailService,
        BarCodeUnique $barCodeUniqueSpec
    ) {
        $this->document = $document;
        $this->documentRepository = $documentRepository;
        $this->emailService = $emailService;
        $this->barCodeUniqueSpec = $barCodeUniqueSpec;
    }

    public function execute(CreateDocumentInput $input)
    {

        if (!$this->barCodeUniqueSpec->isSatisfiedBy($input->barCode)) {
            $input->modelState->add('document_repository', sprintf('Barcode %s already exists', $input->barCode));
            $this->outputPort->barcodeAlreadyExists();
            return;
        }

        $this->document->createFrom($input->statusId, $input->dueDate, $input->barCode);
        if (!$this->document->isValid()) {
            $input->modelState->add('document_entity',
                sprintf('Somethig went wrong %s', implode(', ', $this->document->getErrors())));
        }

        if ($input->modelState->isValid()) {

            $this->documentRepository->create($this->document);

            $this->emailService->send('emailto@picpay.com', "bills@picpay.com", "Bem vindo",
                "Boleto registrado com sucesso!!");

            $this->outputPort->ok($this->document);

            return;
        }

        $this->outputPort->invalid($input->modelState);

    }

    public function setOutputPort(IOutputPort $outputPort): void
    {
        $this->outputPort = $outputPort;
    }
}