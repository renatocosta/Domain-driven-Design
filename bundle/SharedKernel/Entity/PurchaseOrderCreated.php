<?php

namespace SharedKernel\Entity;

use SharedKernel\Event\AbstractEvent;

class PurchaseOrderCreated extends AbstractEvent
{

  public function __construct($id)
  {
      $this->setAggregateRootId($id);
  }

}