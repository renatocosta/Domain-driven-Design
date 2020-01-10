<?php

namespace CrossCutting\Domain\Application\Event;

use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;

abstract class AbstractEvent implements EventInterface
{

    /**
     * @var $aggregateRootIdentifier
     */
    protected $aggregateRootIdentifier;

    /**
     * @var string
     */
    private $eventName;

    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    public function __construct(Identified $aggregateRootIdentifier)
    {
        $this->aggregateRootIdentifier = $aggregateRootIdentifier;
        $this->setEventName();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): Identified
    {
        return $this->aggregateRootIdentifier;
    }

    private function setEventName(): void
    {
        $path = explode('\\', get_class($this));
        $this->eventName = array_pop($path);
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

}