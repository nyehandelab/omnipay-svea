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

    protected function getOrderItems()
    {
        $orderItems = [];
        $items = $this->getItems();

        if ($items) {
            foreach ($items as $item) {
                $orderItems[] = [
                    'Name' => $item->getName(),
                    'Quantity' => $item->getQuantity(),
                    'UnitPrice' => $item->getPrice(), // should include vat
                    'ArticleNumber' => $item->getArticleNumber(),
                    'DiscountPercent' => $item->getDiscountPercent(),
                    'DiscountAmount' => $item->getDiscountAmount(),
                    'VatPercent' => $item->getVatPercent(),
                    'unit' => $item->getUnit(),
                    'MerchantData' => $item->getMerchantData(),
                ];
            }
        }

        return $orderItems;
    }

    /**
     * Set the items in this order
     *
     * @param ItemBag|array $items An array of items in this order
     */
    public function setItems($items)
    {
        if ($items && !$items instanceof ItemBag) {
            $items = new SveaItemBag($items);
        }

        return $this->setParameter('items', $items);
    }
}
