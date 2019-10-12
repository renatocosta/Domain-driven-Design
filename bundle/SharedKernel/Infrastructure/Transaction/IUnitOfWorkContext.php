<?php

namespace SharedKernel\Infrastructure;

interface IUnitOfWorkContext
{

    public function beginTransaction(): void;

    public function commit(): void;

    public function rollback(): void;

}