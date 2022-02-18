<?php

namespace Nyehandel\Omnipay\Svea\Traits;

trait GeneralGatewayParameters
{
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

}
