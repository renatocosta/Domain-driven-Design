<?php

namespace BankSlipCoreDomain\Model\Enroll\Entity;

use BankSlipCoreDomain\Model\Enroll\Entities\Enroll;
use CrossCutting\Application\Event\AbstractEvent;

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