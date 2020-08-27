<?php

namespace DomainBankSlipCore\Application\EventHandlers\Document;

use DomainBankSlipCore\Model\Document\Entity\DocumentWasCreated;
use DomainBankSlipCore\Model\Document\Repositories\IDocumentRepository;
use DomainBankSlipCore\Model\Enroll\Factories\EnrollFactory;
use DomainBankSlipCore\Model\Enroll\Factories\StatusIdFactory;
use DomainBankSlipCore\Model\Enroll\Repositories\IEnrollRepository;
use CrossCutting\Domain\Application\Event\AbstractEvent;
use CrossCutting\Domain\Application\Event\DomainEventHandler;

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
        //May place here any calling to some e.g message queue, kafka or something like that
    }

    public function isSubscribedTo(AbstractEvent $aDomainEvent): bool
    {
        return $aDomainEvent instanceof DocumentWasCreated;
    }

}