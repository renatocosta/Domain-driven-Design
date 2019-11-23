<?php

namespace CrossCutting\Application\Event;

use CrossCutting\Model\ValueObjects\Identity\Identified;

interface EventInterface
{

    /**
     * @return Identified
     */
    public function getId(): Identified;

    /**
     * @return string
     */
    public function getEventName(): string;

    /**
     * @return \DateTimeImmutable
     */
    public function createdAt(): \DateTimeImmutable;

}