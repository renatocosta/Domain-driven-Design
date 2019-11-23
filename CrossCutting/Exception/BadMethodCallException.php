<?php

namespace CrossCutting\Domain\Exception;

use BadMethodCallException as Base;

class BadMethodCallException extends Base implements DomainExceptionInterface
{
}