<?php

namespace SharedKernel\Exception;

use BadMethodCallException as Base;

class BadMethodCallException extends Base implements DomainExceptionInterface
{
}