<?php

namespace SharedKernel\Sample\Entity;

use SharedKernel\Model\Event\ValueObjects\AggregateRoot;
use SharedKernel\Model\ValueObjects\Identity\Email;
use SharedKernel\Model\ValueObjects\Identity\Identified;

class Customer extends AggregateRoot
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $age;

    /**
     * @var Email
     */
    private $email;

    public function __construct(Identified $aggregateRootIdentifier, string $name, float $age, Email $email)
    {
        parent::__construct($aggregateRootIdentifier);
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }

    public function create()
    {
        $this->apply(
            new EntityWasCreated($this->getId())
        );

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): float
    {
        return $this->age;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

}