<?php

namespace AntiCorruptionLayer\Upstream\Providers\MML\Handler;

use AntiCorruptionLayer\Dependencies\IModernRepository;
use AntiCorruptionLayer\Upstream\Enum\EndpointsEnum;
use AntiCorruptionLayer\Upstream\UpstreamHandler;
use Psr\Http\Message\RequestInterface;

class RemittanceHandler extends UpstreamHandler
{

    private $translatorRepository;

    /**
     * @param UpstreamHandler|null $successor
     * @param IModernRepository $translatorRepository
     */
    public function __construct(UpstreamHandler $successor = null, IModernRepository $translatorRepository)
    {
        parent::__construct($successor);
        $this->translatorRepository = $translatorRepository;
    }

    protected function processing(RequestInterface $request): ?string
    {

        if ($request->getUri()->getPath() === EndpointsEnum::CNAB_MANAGER_REMITTANCE) {
            //May calls right here some e.g command handler, service or something else
            //$this->translatorRepository->save();
            return EndpointsEnum::CNAB_MANAGER_REMITTANCE;
        }

        return null;
    }

}