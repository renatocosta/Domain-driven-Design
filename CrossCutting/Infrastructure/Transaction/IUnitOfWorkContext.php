<?php

namespace CrossCutting\Infrastructure;

/**
 * The unit of work implementation manages in-memory database CRUD operations on entities as one transaction
 */
interface IUnitOfWorkContext
{

    public function beginTransaction(): void;

    public function commit(): void;

    public function rollback(): void;

}