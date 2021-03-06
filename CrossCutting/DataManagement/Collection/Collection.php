<?php

namespace CrossCutting\DataManagement\Collection;

class Collection implements ItemsAggregator
{

    /** @var \Iterator */
    private $items;

    public function __construct($iteratorMode = \SplDoublyLinkedList::IT_MODE_KEEP)
    {
        $this->items = new \SplDoublyLinkedList();
        $this->items->setIteratorMode($iteratorMode);
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

    public function isEmpty(): bool
    {
        return $this->items->isEmpty();
    }

}