<?php

namespace CrossCutting\DataManagement\Collection;

class DefaultIterator implements \Iterator
{

    /**
     * @var SplDoublyLinkedList
     */
    private $items;

    public function __construct(Collection $collection)
    {
        $this->items = $collection->getItems();
    }

    public function current(): array
    {
        return $this->items->current();
    }

    public function next(): void
    {
        $this->items->next();
    }

    public function key(): int
    {
        return $this->items->key();
    }

    public function valid(): bool
    {
        return $this->items->valid();
    }

    public function rewind(): void
    {
        $this->items->rewind();
    }

}