<?php

namespace Tests\CrossCutting\Domain\Model\ValueObjects\Identifier;

use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use CrossCutting\Domain\Model\ValueObjects\Identity\Guid;
use CrossCutting\Domain\Model\ValueObjects\Identity\GuidIdentified;

class GuidTest extends TestCase
{

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