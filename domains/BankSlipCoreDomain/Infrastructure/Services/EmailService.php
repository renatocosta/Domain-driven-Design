<?php

namespace BankSlipCoreDomain\Infrastructure\Services;

use CrossCutting\Infrastructure\Services\IEmailService;

class EmailService implements IEmailService
{

    public function send(string $to, string $from, string $subject, string $body): void
    {
        //Mailer::send($to, $from, $subject, $body);
    }

}