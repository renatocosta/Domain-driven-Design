<?php

namespace AntiCorruptionLayer\Upstream\Providers\MML\Downstream\Translator;

use AntiCorruptionLayer\Dependencies\IModernRepository;

class TranslatorMMLRepository implements IModernRepository
{

    private $dataLegacy;

    private $repositoryModern;

    public function __construct(array $dataLegacy, IModernRepository $repositoryModern)
    {
        $this->dataLegacy = $dataLegacy;
        $this->repositoryModern = $repositoryModern;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return array_merge($this->repositoryModern->getAll(), $this->dataLegacy);
    }

    public function save(array $values): void
    {
        //save
    }

}