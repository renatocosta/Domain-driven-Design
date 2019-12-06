<?php

namespace AntiCorruptionLayer\Upstream;

use AntiCorruptionLayer\Dependencies\ModernCoreLegacyRepository;
use AntiCorruptionLayer\Dependencies\ModernMMLRepository;
use AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Handler\TEDHandler;
use AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Handler\TEFHandler;
use AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Downstream\Translator\TranslatorCoreLegacyRepository;
use AntiCorruptionLayer\Upstream\Providers\MML\Handler\DischargeHandler;
use AntiCorruptionLayer\Upstream\Providers\MML\Handler\RemittanceHandler;
use AntiCorruptionLayer\Upstream\Providers\MML\Downstream\Translator\TranslatorMMLRepository;

class ChainHandler
{

    private $incomeData;

    private  $handlers;

    /**
     * @var UpstreamHandler
     */
    private $chain;

    private function statements(): void
    {

        $modernMMLRepository = new ModernMMLRepository();
        $translatorMMLRepository = new TranslatorMMLRepository($this->incomeData, $modernMMLRepository);

        $modernCoreLegacyRepository = new ModernCoreLegacyRepository();
        $translatorCoreLegacyRepository = new TranslatorCoreLegacyRepository($this->incomeData, $modernCoreLegacyRepository);

        $this->handlers = new \SplDoublyLinkedList();
        $this->handlers->push(['class' =>  RemittanceHandler::class, 'dependencies' => [$translatorMMLRepository]]);
        $this->handlers->push(['class' =>  DischargeHandler::class]);
        $this->handlers->push(['class' =>  TEDHandler::class,        'dependencies' => [$translatorCoreLegacyRepository]]);
        $this->handlers->push(['class' =>  TEFHandler::class]);

    }

    private function populate(): void
    {

        $this->chain = null;

        for($this->handlers->rewind(); $this->handlers->valid(); $this->handlers->next()){

            $handler = $this->handlers->current();

            if (empty($handler['class'])) {
                throw new \OutOfBoundsException('Class required');
            }

            $handlerClass = new \ReflectionClass($handler['class']);

            if (empty($handler['dependencies'])) {
                $arguments = [$this->chain];
                $this->chain = $handlerClass->newInstanceArgs($arguments);
                continue;
            }

            $arguments = $handler['dependencies'];
            array_unshift($arguments, $this->chain);
            $this->chain = $handlerClass->newInstanceArgs($arguments);
        }
    }

    public function __construct(array $incomeData)
    {

        $this->incomeData = $incomeData;
        $this->statements();
        $this->populate();

    }

    public function chain(): UpstreamHandler
    {
        return $this->chain;
    }

}