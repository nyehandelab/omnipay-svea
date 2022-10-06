<?php

namespace Nyehandel\Omnipay\Svea\Message;


/**
 * Svea Checkout Authorize Request
 */
class SveaGetAdminOrderRequest extends AbstractAdminRequest
{
    public function getData()
    {
        $this->validate('orderId');

        return [];
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/api/v1/orders/' . $this->getOrderId();
    }

    public function sendData($data)
    {
        $data = json_encode(self::formatData($data));

        $httpResponse = $this->httpClient->request(
            'GET',
            $this->getEndpoint(),
            $this->getHeaders($data),
            $data,
        );

        return new SveaGetAdminOrderResponse(
            $this,
            $this->getResponseBody($httpResponse),
            $httpResponse->getStatusCode()
        );
    }
}
