<?php

namespace Nyehandel\Omnipay\Svea;

/**
 * Nets Easy Checkout Class
 */
class SveaCheckoutGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Svea Checkout';
    }

    public function authorize(array $parameters = [])
    {
        return $this->createRequest('\Nyehandel\Omnipay\Svea\Message\SveaCreateOrderRequest', $parameters);
    }

    public function getOrder(array $parameters = [])
    {
        return $this->createRequest('\Nyehandel\Omnipay\Svea\Message\SveaGetOrderRequest', $parameters);
    }

    public function updateOrder(array $parameters = [])
    {
        return $this->createRequest('\Nyehandel\Omnipay\Svea\Message\SveaUpdateOrderRequest', $parameters);
    }

    public function retrievePayment(array $parameters = [])
    {
        return $this->createRequest('\Nyehandel\Omnipay\Svea\Message\SveaGetOrderRequest', $parameters);
    }

    public function capture(array $parameters = [])
    {
        return $this->createRequest('\Nyehandel\Omnipay\Svea\Message\SveaDeliverOrderRequest', $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        // TODO: Implement completePurchase
    }

    public function cancel(array $parameters = [])
    {
        return $this->createRequest('\Nyehandel\Omnipay\Svea\Message\SveaCancelOrderRequest', $parameters);
    }

    public function refund(array $parameters = [])
    {
        // TODO: Implement refund
    }
}
