<?php

namespace AntiCorruptionLayer\Dependencies\Modern;

class ModernCoreLegacyRepository implements IModernRepository
{

    /**
     * @return array
     */
    public function getAll(): array
    {
        return [
                ['name' => 'Renato - modern Core legacy'],
                ['name' => 'Ricardo - modern Core legacy']
               ];
    }

    public function save(array $values): void
    {
        //save
    }

}