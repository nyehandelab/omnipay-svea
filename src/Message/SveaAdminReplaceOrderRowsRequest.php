<?php

namespace Nyehandel\Omnipay\Svea\Message;

use Nyehandel\Omnipay\Svea\Message\AbstractOrderRequest;

/**
 * Nets Easy Checkout Authorize Request
 */
class SveaAdminReplaceOrderRowsRequest extends AbstractAdminRequest
{
    public function getData()
    {
        $this->validate('items');

        $data = [
            'OrderRows' => $this->getOrderItems(),
        ];

        return $data;
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/api/v1/orders/' . $this->getOrderId() . '/rows/replaceOrderRows/';
    }

    public function sendData($data)
    {
        $data = json_encode(self::formatData($data));

        $httpResponse = $this->httpClient->request(
            'PUT',
            $this->getEndpoint(),
            $this->getHeaders($data),
            $data,
        );

        return new SveaAdminReplaceOrderRowsResponse(
            $this,
            $this->getResponseBody($httpResponse),
            $httpResponse->getStatusCode()
        );
    }
}
