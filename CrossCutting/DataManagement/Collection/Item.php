<?php

namespace CrossCutting\DataManagement\Collection;

interface Item
{

    /**
     * @return \Iterator
     */
    public function getItems(): \Iterator;

    /**
     * @param mixed $item
     */
    public function add($item): void;

}