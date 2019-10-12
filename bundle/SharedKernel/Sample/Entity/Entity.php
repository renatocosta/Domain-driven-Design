<?php

namespace SharedKernel\Sample\Entity;

use SharedKernel\Model\Event\ValueObjects\AggregateRoot;
use SharedKernel\Model\ValueObjects\Identity\Identified;

class Entity extends AggregateRoot
{

    public function __construct(Identified $aggregateRootIdentifier)
    {
        parent::__construct($aggregateRootIdentifier);
    }

    public function create(Identified $aggregateRootIdentifier)
    {

        $this->apply(
            new EntityWasCreated($this->getId())
        );

    }

}