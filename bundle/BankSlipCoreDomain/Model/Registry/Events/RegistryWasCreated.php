<?php

namespace BankSlipCoreDomain\Model\Registry\Entity;

use BankSlipCoreDomain\Model\Registry\Entities\Registry;
use SharedKernel\Model\Event\AbstractEvent;

class RegistryWasCreated extends AbstractEvent
{

    /**
     * @var Registry
     */
    public $registry;

    public function __construct(Registry $registry)
    {
        parent::__construct($registry->getId());
        $this->registry = $registry;
    }

}