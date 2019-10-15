<?php

namespace Bills\Model\Bills\Entity;

use SharedKernel\Model\Event\AbstractEvent;
use SharedKernel\Model\ValueObjects\Identity\Identified;

class DocumentWasCreated extends AbstractEvent
{

    /**
     * @var string
     */
    public $dueDate;

    /**
     * @var string
     */
    public $barCode;

    public function __construct(Identified $id, string $dueDate, string $barCode)
    {
        parent::__construct($id);
        $this->dueDate = $dueDate;
        $this->barCode = $barCode;
    }

}