<?php

namespace Product\Model\Model1\Factories;

use http\Encoding\Stream\Enbrotli;
use SharedKernel\Model\ValueObjects\Identity\Identified;
use SharedKernel\Sample\Entity\Entity;

class Item1Factory
{

    public static function createEntity(): Entity
    {
        //return Entity::create($identified->getId());
    }

    public static function createEntityFromRepository(Identified $identified): Entity
    {
       // return Entity::creta($identified->getId());
    }

}