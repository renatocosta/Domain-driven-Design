<?php

namespace AntiCorruptionLayer\Upstream\Providers\MML\Handler;

use AntiCorruptionLayer\Upstream\Enum\EndpointsEnum;
use AntiCorruptionLayer\Upstream\UpstreamHandler;
use Psr\Http\Message\RequestInterface;

class DischargeHandler extends UpstreamHandler
{

    /**
     * @param UpstreamHandler|null $successor
     */
    public function __construct(UpstreamHandler $successor = null)
    {
        parent::__construct($successor);
    }

    protected function processing(RequestInterface $request): ?string
    {
        if ($request->getUri()->getPath() === EndpointsEnum::CNAB_MANAGER_DISCHARGE) {
            return EndpointsEnum::CNAB_MANAGER_DISCHARGE;
        }

        return null;

    }

}