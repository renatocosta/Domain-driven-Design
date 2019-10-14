<?php

namespace SharedKernel\Infrastructure\Services;

interface IEmailService
{
    public function send(string $to, string $from, string $subject, string $body): void;
}