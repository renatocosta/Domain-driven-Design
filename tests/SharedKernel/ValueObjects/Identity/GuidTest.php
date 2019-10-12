<?php

namespace Tests\SharedKernel\ValueObjects\Identifier;

use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use SharedKernel\ValueObjects\Identity\Guid;
use SharedKernel\ValueObjects\Identity\GuidIdentified;

class GuidTest extends TestCase
{

    public function setUp()
    {

    }

    public function testShouldFailToNotEqualsVo()
    {

        $guid = Guid::fromString(Uuid::uuid4()->toString());
        $guid2 = Guid::fromString(Uuid::uuid4()->toString());
        $this->assertFalse($guid->equals($guid2));

    }

    public function testShouldFailToInvalidUuid()
    {
        $this->expectException(InvalidArgumentException::class);
        Guid::fromString('xyzID');
    }

}