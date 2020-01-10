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

    protected function __construct(Identified $aggregateRootIdentifier)
    {
        $this->aggregateRootIdentifier = $aggregateRootIdentifier;
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
        DomainEventBus::instance()->publish($event);
    }

    public function __toString(): string
    {
        return (string)$this->aggregateRootIdentifier->getId();
    }

}