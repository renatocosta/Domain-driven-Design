<?php

namespace AntiCorruptionLayer\Upstream\Providers\MML\Handler;

use AntiCorruptionLayer\Upstream\UpstreamHandler;
use Psr\Http\Message\RequestInterface;

class DischargeHandler extends UpstreamHandler
{

    private $criteria = '/cnab-manager/discharge';

    protected function processing(RequestInterface $request): ?string
    {
        if ($request->getUri()->getPath() === $this->criteria) {
            return $this->criteria;
        }

        return null;

    }

}