<?php

namespace AntiCorruptionLayer\Upstream\Providers\CoreLegacy\Handler;

use AntiCorruptionLayer\Upstream\UpstreamHandler;
use Psr\Http\Message\RequestInterface;

class TEFHandler extends UpstreamHandler
{

    private $criteria = '/core-legacy/tef';

    protected function processing(RequestInterface $request): ?string
    {
        if ($request->getUri()->getPath() === $this->criteria) {
            return $this->criteria;
        }

        return null;

    }

}