<?php

namespace AntiCorruptionLayer\Dependencies;

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