<?php

namespace AntiCorruptionLayer\Upstream;

use Psr\Http\Message\RequestInterface;

abstract class UpstreamHandler
{
    /**
     * @var UpstreamHandler|null
     */
    private $successor = null;

    public function __construct(UpstreamHandler $handler = null)
    {
        $this->successor = $handler;
    }

    /**
     * This approach by using a template method pattern ensures you that
     * each subclass will not forget to call the successor
     *
     * @param RequestInterface $request
     *
     * @return string|null
     */
    final public function handle(RequestInterface $request): ?string
    {

        $processed = $this->processing($request);

        if ($processed === null && $this->successor !== null) {
            // the request has not been processed by this handler => see the next
            $processed = $this->successor->handle($request);
        }

        return $processed;
    }

    abstract protected function processing(RequestInterface $request): ?string;
}