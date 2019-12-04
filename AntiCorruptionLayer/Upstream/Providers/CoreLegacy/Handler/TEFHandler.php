<?php

namespace AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Handler;

use AntiCorruptionLayer\Upstream\Enum\EndpointsEnum;
use AntiCorruptionLayer\Upstream\UpstreamHandler;
use Psr\Http\Message\RequestInterface;

class TEFHandler extends UpstreamHandler
{

    protected function processing(RequestInterface $request): ?string
    {

        if ($request->getUri()->getPath() === EndpointsEnum::CORE_LEGACY_TEF) {
            return $this->criteria;
        }

        return null;

    }

}