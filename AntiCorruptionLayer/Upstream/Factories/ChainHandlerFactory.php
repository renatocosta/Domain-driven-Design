<?php

namespace AntiCorruptionLayer\Upstream\Factories;

use AntiCorruptionLayer\Dependencies\ModernCoreLegacyRepository;
use AntiCorruptionLayer\Dependencies\ModernMMLRepository;
use AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Handler\TEDHandler;
use AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Handler\TEFHandler;
use AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Downstream\Translator\TranslatorCoreLegacyRepository;
use AntiCorruptionLayer\Upstream\Providers\MML\Handler\DischargeHandler;
use AntiCorruptionLayer\Upstream\Providers\MML\Handler\RemittanceHandler;
use AntiCorruptionLayer\Upstream\Providers\MML\Downstream\Translator\TranslatorMMLRepository;
use AntiCorruptionLayer\Upstream\UpstreamHandler;

class ChainHandlerFactory
{

    public static function create(array $incomeData): UpstreamHandler
    {

        //Dependencies
        $modernMMLRepository = new ModernMMLRepository();
        $translatorMMLRepository = new TranslatorMMLRepository($incomeData, $modernMMLRepository);

        $modernCoreLegacyRepository = new ModernCoreLegacyRepository();
        $translatorCoreLegacyRepository = new TranslatorCoreLegacyRepository($incomeData, $modernCoreLegacyRepository);


        //Handlers

        //MML
        $discharge = new DischargeHandler();
        $remittance = new RemittanceHandler($discharge, $translatorMMLRepository);

        //Core-legacy
        $ted = new TEDHandler($remittance, $translatorCoreLegacyRepository);
        $chain = new TEFHandler($ted);

        return $chain;

    }

}