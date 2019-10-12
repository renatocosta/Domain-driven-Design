<?php

namespace SharedKernel\Sample\Entity;

use SharedKernel\Event\AbstractEvent;
use SharedKernel\ValueObjects\Identity\Identified;

class EntityWasCreated extends AbstractEvent
{

    public function __construct(Identified $id)
    {
        parent::__construct($id);
    }

}