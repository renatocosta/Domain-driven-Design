<?php

namespace BankSlipCoreDomain\Model\Document\Entity;

use BankSlipCoreDomain\Model\Document\Repositories\IDocumentRepository;
use BankSlipCoreDomain\Model\Registry\Factories\RegistryFactory;
use BankSlipCoreDomain\Model\Registry\Factories\StatusIdFactory;
use BankSlipCoreDomain\Model\Registry\Repositories\IRegistryRepository;
use SharedKernel\Model\Event\AbstractEvent;
use SharedKernel\Model\Event\DomainEventHandler;

class DocumentWasCreatedEventHandler implements DomainEventHandler
{

    /**
     * @var IDocumentRepository
     */
    private $billsRepository;

    /**
     * @var IRegistryRepository
     */
    private $registryRepository;

    public function __construct(IDocumentRepository $billsRepository, IRegistryRepository $registryRepository)
    {
        $this->billsRepository = $billsRepository;
        $this->registryRepository = $registryRepository;
    }

    public function handle(AbstractEvent $aDomainEvent): void
    {
        $this->billsRepository->create($aDomainEvent->document);
        $status = StatusIdFactory::create();
        $registry = RegistryFactory::create($status, $aDomainEvent->document);
        $this->registryRepository->create($registry);
        //May place here any calling to some e.g message queue or kafka or something for
    }

    public function isSubscribedTo(AbstractEvent $aDomainEvent): bool
    {
        return $aDomainEvent instanceof DocumentWasCreated;
    }

}