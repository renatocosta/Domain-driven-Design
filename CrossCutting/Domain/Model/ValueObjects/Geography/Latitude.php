<?php

namespace CrossCutting\Domain\Model\ValueObjects\Geography;

class Latitude
{

    public const MIN_LATITUDE = -90;

    public const MAX_LATITUDE = 90;

    private $exceptionMessage = 'Latitude must be between %s and %s';

    private $value;

    public function __construct(float $value)
    {
        if ($value < self::MIN_LATITUDE || $value > self::MAX_LATITUDE) {
            $exceptionMessage = sprintf($this->exceptionMessage, self::MIN_LATITUDE, self::MAX_LATITUDE);
            throw new \Exception($exceptionMessage);
        }
        $this->value = $value;
    }

    public function value(): float
    {
       return $this->value;
    }

}