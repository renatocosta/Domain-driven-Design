<?php

namespace SharedKernel\Sample\Entity;

use SharedKernel\Model\Event\AbstractEvent;
use SharedKernel\Model\ValueObjects\Identity\Identified;

class DocumentWasChanged extends AbstractEvent
{

    public function __construct(Identified $id)
    {
        parent::__construct($id);
    }

}