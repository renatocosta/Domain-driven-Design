<?php

namespace BankSlipCoreDomain\Application\Document\EventHandlers;

use BankSlipCoreDomain\Model\Document\Entity\DocumentWasCreated;
use BankSlipCoreDomain\Model\Document\Repositories\IDocumentRepository;
use BankSlipCoreDomain\Model\Enroll\Factories\EnrollFactory;
use BankSlipCoreDomain\Model\Enroll\Factories\StatusIdFactory;
use BankSlipCoreDomain\Model\Enroll\Repositories\IEnrollRepository;
use CrossCutting\Application\Event\AbstractEvent;
use CrossCutting\Application\Event\DomainEventHandler;

class DocumentWasCreatedEventHandler implements DomainEventHandler
{

    /**
     * @var IDocumentRepository
     */
    private $billsRepository;

    /**
     * @var IEnrollRepository
     */
    private $enrollRepository;

    public function __construct(IDocumentRepository $billsRepository, IEnrollRepository $enrollRepository)
    {
        $this->billsRepository = $billsRepository;
        $this->enrollRepository = $enrollRepository;
    }

    public function handle(AbstractEvent $aDomainEvent): void
    {
        $this->billsRepository->create($aDomainEvent->document);
        $status = StatusIdFactory::create();
        $enroll = EnrollFactory::create($status, $aDomainEvent->document);
        $this->enrollRepository->create($enroll);
        //May place here any calling to some e.g message queue or kafka or something for
    }

    public function isSubscribedTo(AbstractEvent $aDomainEvent): bool
    {
        return $aDomainEvent instanceof DocumentWasCreated;
    }

}