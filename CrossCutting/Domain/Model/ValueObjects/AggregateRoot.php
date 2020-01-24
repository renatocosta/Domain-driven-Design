<?php

namespace CrossCutting\Domain\Model\Event\ValueObjects;

use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use CrossCutting\Domain\Application\Event\EventInterface;
use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;

abstract class AggregateRoot
{

    /**
     * @var Identified
     */
    protected $aggregateRootIdentifier;

    /**
     * @var DomainEventBus
     */
    protected $domainEventBus;

    protected function __construct(Identified $aggregateRootIdentifier, DomainEventBus $domainEventBus)
    {
        $this->aggregateRootIdentifier = $aggregateRootIdentifier;
        $this->domainEventBus = $domainEventBus;
    }

    public function getId(): Identified
    {
        return $this->aggregateRootIdentifier;
    }

    final public function equals(Identified $aggregateRootIdentifier): bool
    {
        return $this->aggregateRootIdentifier->equals($aggregateRootIdentifier);
    }

    final protected function apply(EventInterface $event): void
    {
        $this->domainEventBus->publish($event);
    }

    public function __toString(): string
    {
        return (string)$this->aggregateRootIdentifier->getId();
    }

}