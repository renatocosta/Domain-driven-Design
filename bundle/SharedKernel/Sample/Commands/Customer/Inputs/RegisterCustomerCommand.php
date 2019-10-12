<?php

namespace SharedKernel\Sample\Commands\Customer\Inputs;

use Assert\Assert;
use Assert\AssertionFailedException;

class RegisterCustomerCommand
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $age;

    /**
     * @var string
     */
    public $email;

    /**
     * @var bool
     */
    private $valid;

    /**
     * @var array
     */
    private $errorFields;

    public function __construct(string $name, int $age, string $email)
    {
        try {
            Assert::that($name, 'Name')->notEmpty()->minLength(10)->max(100);
            Assert::that($age, 'Age')->notEmpty()->greaterThan(10);
            Assert::that($email, 'Email')->email();
            $this->name = $name;
            $this->age = $age;
            $this->email = $email;
        } catch(AssertionFailedException $e) {
            $this->valid = false;
            $this->errorFields = $e->getConstraints();
        }

    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function inputErrors(): array
    {
        return $this->errorFields;
    }

    public function asArray(): array
    {
        return [
            'name'  => $this->name,
            'age'   => $this->age,
            'email' => $this->email
        ];
    }

}