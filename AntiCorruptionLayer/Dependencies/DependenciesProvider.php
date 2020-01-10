<?php

namespace AntiCorruptionLayer\Dependencies;

use AntiCorruptionLayer\Upstream\Providers\MML\Downstream\Translator\TranslatorMMLRepository;

class DependenciesProvider
{

    private $dependencies = [];

    public function __construct($incomeData)
    {
        $this->dependencies['modernMMLRepository'] = new ModernMMLRepository();
        $this->dependencies['translatorMMLRepository'] = new TranslatorMMLRepository($incomeData,
            $this->dependencies['modernMMLRepository']);
        $this->dependencies['modernCoreLegacyRepository'] = new ModernCoreLegacyRepository();

    }

    public function dependencies(): array
    {
        return $this->dependencies;
    }

}