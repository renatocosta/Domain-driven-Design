<?php

namespace AntiCorruptionLayer\Upstream\Providers;

use AntiCorruptionLayer\Dependencies\DependenciesProvider;
use AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Handler\TEDHandler;
use AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Handler\TEFHandler;
use AntiCorruptionLayer\Upstream\Providers\MML\Handler\DischargeHandler;
use AntiCorruptionLayer\Upstream\Providers\MML\Handler\RemittanceHandler;
use CrossCutting\DataManagement\Collection\Collection;
use CrossCutting\DataManagement\Collection\Items;

class HandlersProvider
{

    /**
     * @var Collection
     */
    private $handlers;

    public function __construct(DependenciesProvider $dependencies, Items $handlers)
    {

        $dependencies = $dependencies->dependencies();

        $this->handlers = $handlers;
        $this->handlers->add([
            'class' => RemittanceHandler::class,
            'dependencies' => [
                $dependencies['translatorMMLRepository']
            ]
        ]);

        $this->handlers->add(['class' => DischargeHandler::class]);

        $this->handlers->add([
            'class' => TEDHandler::class,
            'dependencies' => [
                $dependencies['modernCoreLegacyRepository']
            ]
        ]);

        $this->handlers->add(['class' => TEFHandler::class]);

    }

    public function handlers(): Items
    {
        return $this->handlers;
    }

}