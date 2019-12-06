<?php

namespace Tests\AntiCorruptionLayer;

use AntiCorruptionLayer\Upstream\ChainHandler;
use AntiCorruptionLayer\Upstream\Enum\EndpointsEnum;
use AntiCorruptionLayer\Upstream\NothingToDoHandler;
use AntiCorruptionLayer\Upstream\UpstreamHandler;
use Tests\BaseUnitTestCase;

class HandlerTest extends BaseUnitTestCase
{

    /**
     * @var UpstreamHandler
     */
    private $chain;

    protected function setUp(): void
    {
        $incomeData = $this->faker()->words;
        $this->chain = new ChainHandler($incomeData);
    }

    public function endPoints(): array
    {
        return [EndpointsEnum::NAMES];
    }

    /**
     * @param string $endpoint
     * @dataProvider  endPoints
     */
    public function testShouldHandlingProviders(string $endpoint)
    {
        $uri = $this->createMock('Psr\Http\Message\UriInterface');
        $uri->method('getPath')->willReturn($endpoint);

        $request = $this->createMock('Psr\Http\Message\RequestInterface');
        $request->method('getUri')->willReturn($uri);
        $this->assertSame($endpoint, $this->chain->chain()->handle($request));
    }

}