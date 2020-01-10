<?php

namespace CrossCutting\DataManagement\Collection;

class DefaultIterator implements \Iterator
{

    /**
     * @var \Iterator
     */
    private $items;

    public function __construct(\Iterator $items)
    {
        $this->items = $items;
        $this->rewind();
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