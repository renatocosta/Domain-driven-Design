<?php

namespace AntiCorruptionLayer\Dependencies\Modern;

class ModernMMLRepository implements IModernRepository
{

    /**
     * @return array
     */
    public function getAll(): array
    {
        return [
                ['name' => 'Renato - modern MML'],
                ['name' => 'Ricardo - modern MML']
               ];
    }

    public function save(array $values): void
    {
        //save
    }

}