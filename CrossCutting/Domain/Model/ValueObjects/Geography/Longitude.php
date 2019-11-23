<?php

namespace CrossCutting\Domain\Model\ValueObjects\Geography;

class Longitude
{

    public const MIN_LONGITUDE = -180;

    public const MAX_LONGITUDE = 180;

    private $exceptionMessage = 'Longitude must be between %s and %s';

    private $value;

    public function __construct(float $value)
    {
        if ($value < self::MIN_LONGITUDE || $value > self::MAX_LONGITUDE) {
            $exceptionMessage = sprintf($this->exceptionMessage, self::MIN_LONGITUDE, self::MAX_LONGITUDE);
            throw new \Exception($exceptionMessage);
        }
        $this->value = $value;
    }

    public function value(): float
    {
       return $this->value;
    }

}