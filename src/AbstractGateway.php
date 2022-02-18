<?php

namespace Nyehandel\Omnipay\Svea;

use Nyehandel\Omnipay\Svea\Traits\GeneralGatewayParameters;
use Omnipay\Common\AbstractGateway as CommonAbstractGateway;

/**
 * Nets Easy Checkout Class
 */
abstract class AbstractGateway extends CommonAbstractGateway
{
    use GeneralGatewayParameters;

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'checkoutSecret' => '',
            'testMode' => false,
        );
    }
}
