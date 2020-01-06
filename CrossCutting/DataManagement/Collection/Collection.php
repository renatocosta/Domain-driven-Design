<?php

namespace CrossCutting\DataManagement\Collection;

class Collection implements \IteratorAggregate, Item, \Countable
{

    /** @var \Iterator  */
    private $items;

    public function __construct()
    {
       $this->items = new \SplDoublyLinkedList();
    }

    public function getIterator(): \Iterator
    {
        return new DefaultIterator($this->getItems());
    }

    public function getItems(): \Iterator
    {
        return $this->items;
    }

    public function count(): int
    {
        return $this->items->count();
    }

    public function add($item): void
    {
        $this->items->push($item);
    }

}