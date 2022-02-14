<?php

namespace Nyehandel\Omnipay\Svea\Message;

/**
 * Svea Checkout Authorize Request
 */
class SveaGetOrderRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('paymentId');

        return [];
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/api/orders/' . $this->getPaymentId();
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
            'GET',
            $this->getEndpoint(),
            $this->getHeaders(),
        );

        return new SveaGetOrderResponse(
            $this,
            $this->getResponseBody($httpResponse),
            $httpResponse->getStatusCode()
        );
    }
}
