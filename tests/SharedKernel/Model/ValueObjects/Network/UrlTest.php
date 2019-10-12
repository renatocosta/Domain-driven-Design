<?php

namespace Tests\SharedKernel\Model\ValueObjects\Network;

use SharedKernel\Model\ValueObjects\Identity\Email;
use SharedKernel\Model\ValueObjects\Network\Url;
use Tests\BaseUnitTestCase;

class UrlTest extends BaseUnitTestCase
{

    public function testShouldReturnUrl(): void
    {
        $url = $this->faker()->url;
        $urlVO = new Url($url);
        $this->assertSame($url, $urlVO->value());
    }

    public function invalidUrlProvider(): array
    {
        return [
            [$this->faker()->email],
            [$this->faker()->century]
        ];
    }

    /**
     *
     * @dataProvider invalidUrlProvider
     */
    public function testItShouldFailToInvalid(string $data)
    {
        $this->expectException(\Exception::class);

        new Url($data);
    }

}