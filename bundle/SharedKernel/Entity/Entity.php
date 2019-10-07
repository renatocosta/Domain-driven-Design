<?php

namespace SharedKernel\Entity;

use SharedKernel\ValueObjects\AggregateRoot;
use SharedKernel\ValueObjects\Identity\Identifier;

class Entity extends AggregateRoot
{

    public function __construct($identifier)
    {
        $this->apply(new PurchaseOrderCreated(111));
    }

    /**
     * The apply() method will automatically call this method.
     * Since it's an event you should never do some tests in this method.
     * Try to think that an Event is something that happened in the past.
     * You can not modify what happened. The only thing that you can do is create another event to compensate.
     */
    protected function applyPurchaseOrderCreated(PurchaseOrderCreated $event)
    {
        //$this->customerId = $event->getCustomer()->getId();
    }

}