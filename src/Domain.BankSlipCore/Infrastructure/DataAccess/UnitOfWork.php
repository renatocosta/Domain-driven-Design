<?php

namespace DomainBankSlipCore\Infrastructure\DataAccess;

use CrossCutting\Domain\Infrastructure\IUnitOfWorkContext;

class UnitOfWork implements IUnitOfWorkContext
{

    public function beginTransaction(): void
    {
        //DB::beginTransaction();
    }

    public function commit(): void
    {
        //DB::commit();
    }

    public function rollback(): void
    {
        //DB::rollBack();
    }

}