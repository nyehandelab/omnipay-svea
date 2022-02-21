<?php
/**
 * Svea Abstract Request
 */

namespace Nyehandel\Omnipay\Svea\Message;

use Nyehandel\Omnipay\Svea\SveaItemBag;
use Omnipay\Common\ItemBag;
use Psr\Http\Message\ResponseInterface;

/**
 * Svea Abstract Admin Request
 *
 * This class forms the base class for Svea Payment Admin requests.
 *
 * @link https://paymentadminapi.svea.com/documentation/#/?id=using-paymentadmin-api
 */
abstract class AbstractAdminRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://paymentadminapi.svea.com';
    protected $testEndpoint = 'https://paymentadminapistage.svea.com';

    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }
}
