<?php

namespace Bills\Model\Bill\Enums;

class StatusIdEnum
{

    public const STATUS_SCHEDULED = 'G';

    public const STATUS_LIQUIDATED = 'L';

    public const STATUS = [self::STATUS_SCHEDULED, self::STATUS_LIQUIDATED];

}