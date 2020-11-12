<?php

namespace DomainBankSlipCore\Model\Enroll\Entity;

use DomainBankSlipCore\Model\Enroll\Entities\Enroll;
use CrossCutting\Domain\Application\Event\AbstractEvent;

class EnrollWasCreated extends AbstractEvent
{

    /**
     * @var Enroll
     */
    public $enroll;

    public function __construct(Enroll $enroll)
    {
        parent::__construct($enroll->getId());
        $this->enroll = $enroll;
    }

}