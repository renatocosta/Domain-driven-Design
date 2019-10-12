<?php

namespace Tests;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

abstract class BaseUnitTestCase extends TestCase
{

    private $faker;

    protected function faker(): Generator
    {
        return $this->faker = $this->faker ?: Factory::create();
    }

}