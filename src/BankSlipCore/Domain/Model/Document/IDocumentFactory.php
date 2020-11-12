<?php

namespace BankSlipCore\Domain\Model\Document;

use CrossCutting\Domain\Model\ValueObjects\Identity\Identified;

interface IDocumentFactory
{

    /**
     * @return Documentable
     */
    public function newDocument(): Documentable;

    /**
     * @param Identified $identity
     * @return Documentable
     */
    public function newFromExisting(Identified $identity): Documentable;

    /**
     * @return Documentable
     */
    public function newNullDocument(): Documentable;

}