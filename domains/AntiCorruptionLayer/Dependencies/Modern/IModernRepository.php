<?php

namespace AntiCorruptionLayer\Dependencies\Modern;

interface IModernRepository
{

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param array $values
     */
    public function save(array $values): void;

}