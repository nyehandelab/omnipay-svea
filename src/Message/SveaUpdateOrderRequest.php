<?php

namespace Nyehandel\Omnipay\Svea\Message;

use Nyehandel\Omnipay\Svea\Message\AbstractOrderRequest;

/**
 * Nets Easy Checkout Authorize Request
 */
class SveaUpdateOrderRequest extends AbstractOrderRequest
{
    public function getData()
    {
        $this->validate('items');

        $data = [
            'cart' => $this->getCartData(),
            'merchantData' => $this->getMerchantData(),
        ];

        return $data;
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/api/orders/' . $this->getPaymentId();
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
            'PUT',
            $this->getEndpoint(),
            $this->getHeaders(),
            json_encode($data),
        );

        return new SveaUpdateOrderResponse($this, $this->getResponseBody($httpResponse));
    }
}
