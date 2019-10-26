<?php

namespace AntiCorruptionLayer\Upstream\Providers\MML\Handler;

use AntiCorruptionLayer\Dependencies\Modern\IModernRepository;
use AntiCorruptionLayer\Upstream\UpstreamHandler;
use Psr\Http\Message\RequestInterface;

class RemittanceHandler extends UpstreamHandler
{

    private $criteria = '/cnab-manager/remittance';

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

        if ($request->getUri()->getPath() === $this->criteria) {
            //May calls right here some e.g command handler, service or something else
            //$this->translatorRepository->save();
            return $this->criteria;
        }

        return null;
    }

}