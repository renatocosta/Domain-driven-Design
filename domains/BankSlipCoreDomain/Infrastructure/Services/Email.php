<?php

namespace BankSlipCoreDomain\Infrastructure\Services;

use CrossCutting\Domain\Infrastructure\Services\IEmailService;

class Email implements IEmailService
{

    public function send(string $to, string $from, string $subject, string $body): void
    {
        //Mailer::send($to, $from, $subject, $body);
    }

}