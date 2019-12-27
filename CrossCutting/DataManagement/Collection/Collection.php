<?php

namespace CrossCutting\DataManagement\Collection;

class Collection implements \IteratorAggregate
{

    /** @var SplDoublyLinkedList */
    private $items;

    public function __construct()
    {
       $this->items = new \SplDoublyLinkedList();
    }

    public function getIterator(): DefaultIterator
    {
        return new DefaultIterator($this);
    }

    public function getItems(): \SplDoublyLinkedList
    {
        return $this->items;
    }

    public function count(): int
    {
        return $this->items->count();
    }

    public function addItem(array $item): void
    {
        $this->items->push($item);
    }

}