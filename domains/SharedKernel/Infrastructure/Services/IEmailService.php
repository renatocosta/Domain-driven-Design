<?php

namespace SharedKernel\Infrastructure\Services;

interface IEmailService
{
    /**
     * @param string $to
     * @param string $from
     * @param string $subject
     * @param string $body
     */
    public function send(string $to, string $from, string $subject, string $body): void;

}