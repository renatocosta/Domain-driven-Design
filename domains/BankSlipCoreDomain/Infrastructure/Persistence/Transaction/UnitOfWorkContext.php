<?php

namespace BankSlipCoreDomain\Infrastructure\Transaction;

use SharedKernel\Infrastructure\IUnitOfWorkContext;

class UnitOfWorkContext implements IUnitOfWorkContext
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