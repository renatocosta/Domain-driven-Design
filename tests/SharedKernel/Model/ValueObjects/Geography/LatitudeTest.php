<?php

namespace Tests\SharedKernel\Model\ValueObjects\Geography;

use SharedKernel\Model\ValueObjects\Geography\Latitude;
use Tests\BaseUnitTestCase;

class LatitudeTest extends BaseUnitTestCase
{

    public function testShouldReturnLatitude(): void
    {
        $latitude = $this->faker()->latitude;
        $latVo = new Latitude($latitude);
        $this->assertSame($latitude, $latVo->value());
    }

    public function invalidLatitudeProvider(): array
    {
        return [
            [$this->faker()->randomFloat(4, -200, -95)],
            [$this->faker()->randomFloat(4, 100, 200)]
        ];
    }

    /**
     *
     * @dataProvider invalidLatitudeProvider
     */
    public function testShouldThrowsException(float $data): void
    {
        $this->expectException(\Exception::class);
        new Latitude($data);
    }

}