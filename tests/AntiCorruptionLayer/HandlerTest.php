<?php

namespace Tests\AntiCorruptionLayer;

use AntiCorruptionLayer\Upstream\Factories\ChainHandlerFactory;
use AntiCorruptionLayer\Upstream\NothingToDoHandler;
use Tests\BaseUnitTestCase;

class HandlerTest extends BaseUnitTestCase
{

    /**
     * @var Handler
     */
    private $chain;

    protected function setUp(): void
    {
        $incomeData = $this->faker()->words;
        $this->chain = ChainHandlerFactory::create($incomeData);
    }

    public function endPoints(): array
    {
        return [
            ['/cnab-manager/remittance'],
            ['/cnab-manager/discharge'],
            ['/core-legacy/tef'],
            ['/core-legacy/ted']
        ];
    }

    /**
     *
     * @dataProvider endPoints
     */
    public function testShouldHandlingProviders(string $endpoint)
    {
        $uri = $this->createMock('Psr\Http\Message\UriInterface');
        $uri->method('getPath')->willReturn($endpoint);

        $request = $this->createMock('Psr\Http\Message\RequestInterface');
        $request->method('getUri')->willReturn($uri);

        $this->assertSame($endpoint, $this->chain->handle($request));
    }

}