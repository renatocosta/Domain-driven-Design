<?php

namespace AntiCorruptionLayer\Contracts;

interface ICoordinator
{
    /**
     * @return array
     */
    public function getData(): array;
}