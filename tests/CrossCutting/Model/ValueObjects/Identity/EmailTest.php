<?php

namespace Tests\CrossCutting\Domain\Model\ValueObjects\Identifier;

use CrossCutting\Domain\Model\ValueObjects\Identity\Email;
use Tests\BaseUnitTestCase;

class EmailTest extends BaseUnitTestCase
{

    public function testShouldReturnEmail(): void
    {
        $email = $this->faker()->email;
        $emailVO = new Email($email);
        $this->assertSame($email, $emailVO->value());
    }

    public function invalidEmailProvider(): array
    {
        return [
            [$this->faker()->address],
            [$this->faker()->numberBetween()]
        ];
    }

    /**
     *
     * @dataProvider invalidEmailProvider
     */
    public function testItShouldFailToInvalid(string $data)
    {
        $this->expectException(\Exception::class);

        new Email($data);
    }

}