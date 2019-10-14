<?php

namespace Tests\SharedKernel\Model\ValueObjects\Identifier;

use SharedKernel\Model\ValueObjects\Identity\FindValueIn;
use Tests\BaseUnitTestCase;

class EnumTest extends BaseUnitTestCase
{

    public function testShouldThrowInvalidEnumException(): void
    {
        $this->expectException(\Exception::class);
        new FindValueIn('invalid', ['key' => 222]);
    }

    public function testShouldReturnEnumValue(): void
    {

        $acquirer = ['Stone', 'Cielo'];
        $findIt = 'Cielo';
        $value = new FindValueIn($findIt, $acquirer);
        $this->assertSame($findIt, $value->value());
    }

}