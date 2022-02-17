<?php
declare(strict_types=1);

namespace Nyehandel\Omnipay\Svea\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

final class SveaCreateOrderResponse extends Response implements RedirectResponseInterface
{
    /**
     * @inheritDoc
     */
    public function isSuccessful(): bool
    {
        /*
         * HTTP status code 201 indicates that a new Checkout order was created.
         * HTTP status code 200 indicates that an existing Checkout order was found with the provied clientOrderNumber.
         */
        return $this->getCode() == 201 || $this->getCode() == 200;
    }
}

