<?php

namespace Nyehandel\Omnipay\Svea\Message;

use Nyehandel\Omnipay\Svea\SveaWebhookBag;
use Omnipay\Common\ItemBag;

/**
 * Svea Checkout Authorize Request
 */
class SveaCancelOrderRequest extends AbstractAdminRequest
{
    public function getData()
    {
        $this->validate(
            'orderId',
        );

        $data = [
            'IsCancelled' => 'true',
        ];

        return $data;
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/api/v1/orders/' . $this->getOrderId();
    }

    protected function getHttpMethod()
    {
        return 'PATCH';
    }

    public function sendData($data)
    {
        $data = json_encode(self::formatData($data));

        $httpResponse = $this->httpClient->request(
            'PATCH',
            $this->getEndpoint(),
            $this->getHeaders($data),
            $data,
        );

        return new SveaCancelOrderResponse(
            $this,
            $this->getResponseBody($httpResponse),
            $httpResponse->getStatusCode()
        );
    }
}
