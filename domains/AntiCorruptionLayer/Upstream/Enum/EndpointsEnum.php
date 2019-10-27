<?php

namespace AntiCorruptionLayer\Upstream\Enum;

class EndpointsEnum
{

    public const CNAB_MANAGER__REMITTANCE = '/cnab-manager/remittance';

    public const CNAB_MANAGER__DISCHARGE = '/cnab-manager/discharge';

    public const CORE_LEGACY_TEF = '/core-legacy/tef';

    public const CORE_LEGACY_TED = '/core-legacy/ted';

    public const NAMES = [self::CNAB_MANAGER__REMITTANCE, self::CNAB_MANAGER__DISCHARGE, self::CORE_LEGACY_TEF, self::CORE_LEGACY_TED];

}