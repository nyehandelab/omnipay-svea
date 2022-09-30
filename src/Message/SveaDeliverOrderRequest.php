<?php

namespace Nyehandel\Omnipay\Svea\Message;

use Nyehandel\Omnipay\Svea\SveaWebhookBag;
use Omnipay\Common\ItemBag;

/**
 * Svea Checkout Authorize Request
 */
class SveaDeliverOrderRequest extends AbstractAdminRequest
{
    public function getData()
    {
        $this->validate(
            'orderId',
        );

        $data ['OrderRowIds'] = $this->getOrderRowIds() ?? [];

        if (null !== $rowDeliveryOptions = $this->getRowDeliveryOptions()) {
            $data['RowDeliveryOptions'] = $rowDeliveryOptions;
        }

        if (null !== $invoiceDistributionType = $this->getInvoiceDistributionType()) {
            $data['InvoiceDistributionType'] = $invoiceDistributionType;
        }

        if (null !== $cancelRemaining = $this->getCancelRemaining()) {
            $data['CancelRemaining'] = $cancelRemaining;
        }

        return $data;
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/api/v1/orders/' . $this->getOrderId(). '/deliveries';
    }

    public function setOrderRowIds($value)
    {
        return $this->setParameter('orderRowIds', $value);
    }

    public function getOrderRowIds()
    {
        return $this->getParameter('orderRowIds');
    }

    public function setRowDeliveryOptions($value)
    {
        return $this->setParameter('rowDeliveryOptions', $value);
    }

    public function getRowDeliveryOptions()
    {
        return $this->getParameter('rowDeliveryOptions');
    }

    public function setInvoiceDistributionType($value)
    {
        return $this->setParameter('invoiceDistributionType', $value);
    }

    public function getInvoiceDistributionType()
    {
        return $this->getParameter('invoiceDistributionType');
    }

    public function setCancelRemaining($value)
    {
        return $this->setParameter('cancelRemaining', $value);
    }

    public function getCancelRemaining()
    {
        return $this->getParameter('cancelRemaining');
    }

    public function sendData($data)
    {
        $data = json_encode(self::formatData($data));

        $httpResponse = $this->httpClient->request(
            'POST',
            $this->getEndpoint(),
            $this->getHeaders($data),
            $data,
        );

        return new SveaDeliverOrderResponse(
            $this,
            $this->getResponseBody($httpResponse),
            $httpResponse->getStatusCode()
        );
    }
}
