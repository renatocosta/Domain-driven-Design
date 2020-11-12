<?php

namespace Tests\UnitTests\Presenters;

use DomainBankSlipCore\Application\Services\Common\Notification;
use DomainBankSlipCore\Application\UseCases\CreateDocument\IOutputPort;
use DomainBankSlipCore\Model\Document\Entities\Documentable;

class CreateDocumentPresenterFake implements IOutputPort
{

    /**
     * @var Notification
     */
    public $modelState;

    /**
     * @var Documentable
     */
    public $document;

    public function invalid(Notification $modelState): void
    {
        $this->modelState = $modelState;
    }

    public function ok(Documentable $document): void
    {
        $this->document = $document;
    }

    public function barcodeAlreadyExists(): void
    {
        throw new \Exception('Barcode Already exists');
    }

}