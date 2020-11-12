<?php

namespace DomainBankSlipCore\Application\UseCases\CreateDocument;

use DomainBankSlipCore\Application\Services\Common\Notification;
use DomainBankSlipCore\Model\Document\Entities\Documentable;

interface IOutputPort
{

    public function invalid(Notification $notification): void;

    public function ok(Documentable $document): void;

    public function barcodeAlreadyExists(): void;

}