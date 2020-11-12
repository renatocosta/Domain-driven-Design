<?php

namespace BankSlipCore\Domain\Model\Document;

class StatusIdEnum
{

    public const STATUS_SCHEDULED = 'G';

    public const STATUS_LIQUIDATED = 'L';

    public const STATUS = [self::STATUS_SCHEDULED, self::STATUS_LIQUIDATED];

}