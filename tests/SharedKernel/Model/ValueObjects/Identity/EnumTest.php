<?php

namespace Tests\SharedKernel\Model\ValueObjects\Identifier;

use SharedKernel\Model\ValueObjects\Identity\Enum;
use Tests\BaseUnitTestCase;

class EnumTest extends BaseUnitTestCase
{

    public function testShouldThrowInvalidEnumException(): void
    {
        $this->expectException(\Exception::class);
        new Enum('invalid');
    }

    public function testShouldReturnEnumValue(): void
    {
        $data = Enum::VALID;
        $value = new Enum($data);
        $this->assertSame($data, $value->value());
    }

}