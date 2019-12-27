<?php

namespace Tests\CrossCutting\DataManagement\Collection;

use CrossCutting\DataManagement\Collection\Collection;
use CrossCutting\DataManagement\Collection\DefaultIterator;
use Tests\BaseUnitTestCase;

class CollectionTest extends BaseUnitTestCase
{

    public function testEmptyItemsCollection()
    {
        $collection = new Collection();

        $this->assertEquals(new DefaultIterator($collection), $collection->getIterator());

        $this->assertEquals(0, $collection->count());
    }

    public function testItemsCollectionWithItemElements()
    {
        $collection = new Collection();
        $collection->addItem(['class' =>  \stdClass::class]);
        $collection->addItem(['class' =>  \stdClass::class, 'dependencies' => []]);


        $iterator = new DefaultIterator($collection);
        $iterator->rewind();

        $this->assertEquals(new DefaultIterator($collection), $collection->getIterator());
        $this->assertEquals(['class' =>  \stdClass::class], $collection->getItems()->current());
        $iterator->next();
        $this->assertEquals(['class' =>  \stdClass::class, 'dependencies' => []], $collection->getItems()->current());
        $this->assertEquals(2, $collection->count());
    }

}