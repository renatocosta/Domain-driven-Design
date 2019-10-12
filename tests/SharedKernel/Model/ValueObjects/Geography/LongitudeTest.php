<?php

namespace Tests\SharedKernel\Model\ValueObjects\Geography;

use SharedKernel\Model\ValueObjects\Geography\Longitude;
use Tests\BaseUnitTestCase;

class LongitudeTest extends BaseUnitTestCase
{

    public function testShouldReturnLatitude(): void
    {
        $latitude = $this->faker()->latitude;
        $latVo = new Longitude($latitude);
        $this->assertSame($latitude, $latVo->value());
    }

    public function invalidLatitudeProvider(): array
    {
        return [
            [$this->faker()->randomFloat(4, -200, -185)],
            [$this->faker()->randomFloat(4, 185, 200)]
        ];
    }

    /**
     *
     * @dataProvider invalidLatitudeProvider
     */
    public function testShouldThrowsException(float $data): void
    {
        $this->expectException(\Exception::class);
        new Longitude($data);
    }

}