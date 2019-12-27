<?php

namespace Tests\CrossCutting\DataManagement\Collection;

use CrossCutting\DataManagement\Collection\Collection;
use CrossCutting\DataManagement\Collection\DefaultIterator;
use Tests\BaseUnitTestCase;

class DefaultIteratorTest extends BaseUnitTestCase
{

    public function testCurrent()
    {
        $iterator = $this->getIterator();
        $current = $iterator->current();

        $this->assertEquals(['class' =>  \stdClass::class], $current);
    }

    public function testNext()
    {
        $iterator = $this->getIterator();
        $iterator->next();

        $this->assertEquals(1, $iterator->key());
    }

    public function testKey()
    {
        $iterator = $this->getIterator();

        $iterator->next();
        $iterator->next();

        $this->assertEquals(2, $iterator->key());
    }

    public function testValidIfItemInvalid()
    {
        $iterator = $this->getIterator();

        $iterator->next();
        $iterator->next();
        $iterator->next();

        $this->assertEquals(false, $iterator->valid());
    }

    public function testValidIfItemIsValid()
    {
        $iterator = $this->getIterator();

        $iterator->next();

        $this->assertEquals(true, $iterator->valid());
    }

    public function testRewind()
    {
        $iterator = $this->getIterator();

        $this->assertEquals(0, $iterator->key());
    }

    private function getIterator() : DefaultIterator
    {
        $iterator = $this->getCollection()
                         ->getIterator();
        $iterator->rewind();

        return $iterator;
    }

    private function getCollection() : Collection
    {

        $collection = new Collection();
        $collection->addItem(['class' =>  \stdClass::class]);
        $collection->addItem(['class' =>  \stdClass::class, 'dependencies' => []]);

        return $collection;

    }

}