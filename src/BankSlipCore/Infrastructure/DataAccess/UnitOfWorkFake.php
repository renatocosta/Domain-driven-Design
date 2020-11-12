<?php

namespace DomainBankSlipCore\Infrastructure\DataAccess;

use CrossCutting\Domain\Infrastructure\IUnitOfWork;

class UnitOfWorkFake implements IUnitOfWork
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