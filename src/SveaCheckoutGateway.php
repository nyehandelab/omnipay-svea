<?php

namespace Nyehandel\Omnipay\Svea;

use Omnipay\Common\AbstractGateway;

/**
 * Nets Easy Checkout Class
 */
class SveaCheckoutGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Svea Checkout';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'checkoutSecret' => '',
            'testMode' => false,
        );
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getCheckoutSecret()
    {
        return $this->getParameter('checkoutSecret');
    }

    public function setCheckoutSecret($value)
    {
        return $this->setParameter('checkoutSecret', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Nyehandel\Omnipay\Nets\Message\SveaCreateOrderRequest', $parameters);
    }

    public function updateOrder(array $parameters = array())
    {
        return $this->createRequest('\Nyehandel\Omnipay\Nets\Message\SveaUpdateOrderRequest', $parameters);
    }

    public function retrievePayment(array $parameters = array())
    {
        return $this->createRequest('\Nyehandel\Omnipay\Nets\Message\SveaGetOrderRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        // TODO: Implement paritital purchase
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Nyehandel\Omnipay\Nets\Message\NetsEasyFullChargePaymentRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        // TODO: Implement refund
    }
}
