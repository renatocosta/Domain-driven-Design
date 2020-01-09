<?php

namespace CrossCutting\DataManagement\Collection;

interface Item extends \Countable
{

    /**
     * @return \Iterator
     */
    public function getItems(): \Iterator;

    /**
     * @param mixed $item
     */
    public function add($item): void;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

}