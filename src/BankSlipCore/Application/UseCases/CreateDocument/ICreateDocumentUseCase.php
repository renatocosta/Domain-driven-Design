<?php

namespace DomainBankSlipCore\Application\UseCases\CreateDocument;

use DomainBankSlipCore\Application\UseCases\Document\CreateDocument\CreateDocumentInput;

interface ICreateDocumentUseCase
{

    public function execute(CreateDocumentInput $input);

    public function setOutputPort(IOutputPort $outputPort): void;

}