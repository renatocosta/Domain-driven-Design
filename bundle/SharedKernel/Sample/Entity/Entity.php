<?php

namespace SharedKernel\Sample\Entity;

use SharedKernel\Event\ValueObjects\AggregateRoot;
use SharedKernel\ValueObjects\Identity\Identified;

class Entity extends AggregateRoot
{

    public function __construct(Identified $aggregateRootIdentifier)
    {
        parent::__construct($aggregateRootIdentifier);
    }

    public function create()
    {

        $this->apply(
            new EntityWasCreated($this->getId())
        );

    }

}