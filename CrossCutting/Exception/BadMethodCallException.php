<?php

namespace CrossCutting\Exception;

use BadMethodCallException as Base;

class BadMethodCallException extends Base implements DomainExceptionInterface
{
}