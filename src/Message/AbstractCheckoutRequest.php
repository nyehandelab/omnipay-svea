<?php
/**
 * Svea Abstract Request
 */

namespace Nyehandel\Omnipay\Svea\Message;

use Nyehandel\Omnipay\Svea\Traits\GeneralGatewayParameters;
use Omnipay\Common\ItemBag;
use Nyehandel\Omnipay\Svea\SveaItemBag;
use Psr\Http\Message\ResponseInterface;

/**
 * Svea Abstract Request
 *
 * This class forms the base class for Svea Checkout requests.
 *
 */
abstract class AbstractCheckoutRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://checkoutapi.svea.com';
    protected $testEndpoint = 'https://checkoutapistage.svea.com';

    public $data;

    public function getCheckoutSecret()
    {
        return $this->getParameter('checkoutSecret');
    }

    public function setCheckoutSecret($value)
    {
        return $this->setParameter('checkoutSecret', $value);
    }

    public function setPaymentId($value)
    {
        return $this->setParameter('paymentId', $value);
    }

    public function getPaymentId()
    {
        return $this->getParameter('paymentId');
    }

    public function setReference($value)
    {
        return $this->setParameter('reference', $value);
    }

    public function getReference()
    {
        return $this->getParameter('reference');
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
