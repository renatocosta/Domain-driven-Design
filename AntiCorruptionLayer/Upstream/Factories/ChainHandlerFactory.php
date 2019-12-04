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

    private static $incomeData;

    private static $handlers = [];

    private static function statements(): void
    {
        $modernMMLRepository = new ModernMMLRepository();
        $translatorMMLRepository = new TranslatorMMLRepository(self::$incomeData, $modernMMLRepository);

        $modernCoreLegacyRepository = new ModernCoreLegacyRepository();
        $translatorCoreLegacyRepository = new TranslatorCoreLegacyRepository(self::$incomeData, $modernCoreLegacyRepository);

        self::$handlers['remittance'] = ['class' =>  RemittanceHandler::class, 'dependencies' => [$translatorMMLRepository]];
        self::$handlers['discharge']  = ['class' =>  DischargeHandler::class];
        self::$handlers['ted']        = ['class' =>  TEDHandler::class,        'dependencies' => [$translatorCoreLegacyRepository]];
        self::$handlers['tef']        = ['class' =>  TEFHandler::class];

    }

    private static function dispatch(): UpstreamHandler
    {

        $chain = null;

        foreach (self::$handlers as $name => $handler) {

            if (empty($handler['class'])) {
                throw new \OutOfBoundsException(sprintf('No such class name %s for the handler %s', $handler['class'], $name));
            }

            $handlerClass = new \ReflectionClass($handler['class']);

            if (empty($handler['dependencies'])) {
                $arguments = [$chain];
                $chain = $handlerClass->newInstanceArgs($arguments);
                continue;
            }

            $arguments = $handler['dependencies'];
            array_unshift($arguments, $chain);
            $chain = $handlerClass->newInstanceArgs($arguments);

        }

        return $chain;

    }

    public static function create(array $incomeData): UpstreamHandler
    {

        self::$incomeData = $incomeData;
        self::statements();

        $chain = self::dispatch();

        return $chain;

    }

}