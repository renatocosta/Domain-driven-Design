<?php

namespace SharedKernel\Entity;

use SharedKernel\Event\EventInterface;
use SharedKernel\Event\Listener\EventListenerInterface;

class SendEmailOnPurchaseOrderCreated implements EventListenerInterface
{
    private $mailer;

    public function __construct($mailer)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function getSupportedEventClassName()
    {
        return 'PurchaseOrderCreated'; // Should be the fully qualified class name of the event
    }

    /**
     * {@inheritDoc}
     */
    public function handle(EventInterface $event)
    {
        var_dump('handlesss');

        // $this->mailer->send('to@you.com', 'Purchase order created for customer #' . $event->getCustomer()->getId());
    }
}