<?php

namespace DomainBankSlipCore\Application\Services\Common;

class Notification
{

    /**
     * @var array
     */
    public $errorMessages = [];

    public function isValid(): bool
    {
        return count($this->errorMessages) === 0;
    }

    public function isInvalid(): bool
    {
        return count($this->errorMessages) > 0;
    }

    public function add(string $key, string $message)
    {
        $this->errorMessages[$key] = $message;
    }

}