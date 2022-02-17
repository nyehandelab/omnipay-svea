<?php
/**
 * Svea Abstract Request
 */

namespace Nyehandel\Omnipay\Svea\Message;

use Nyehandel\Omnipay\Svea\SveaItemBag;
use Omnipay\Common\ItemBag;
use Psr\Http\Message\ResponseInterface;

/**
 * Svea Abstract Order Request
 *
 * This class forms the base class for Svea Checkout requests.
 *
 * @link https://checkoutapi.svea.com/docs/#/data-types?id=createordermodel
 * @link https://checkoutapi.svea.com/docs/#/data-types?id=updateordermodel
 */
abstract class AbstractOrderRequest extends AbstractRequest
{
    public function setMerchantData($value)
    {
        return $this->setParameter('merchantData', $value);
    }

    public function getMerchantData()
    {
        return $this->getParameter('merchantData');
    }

    protected function getBaseData()
    {
        return [];
    }

    protected function getCartData()
    {
        $cartData = [];
        $items = $this->getItems();

        if ($items) {
            foreach ($items as $item) {
                $cartData['items'][] = [
                    'Name' => $item->getName(),
                    'Quantity' => $item->getQuantity(),
                    'UnitPrice' => $item->getPrice() + $item->getTaxAmount(),
                    'ArticleNumber' => $item->getArticleNumber(),
                    'DiscountPercent' => $item->getDiscountPercent(),
                    'DiscountAmount' => $item->getDiscountAmount(),
                    'VatPercent' => $item->getVatPercent(),
                    'unit' => $item->getUnit(),
                ];
            }
        }

        return $cartData;
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request('POST', $this->getEndpoint(), [], http_build_query($data));

        return $this->createResponse($httpResponse->getBody()->getContents());
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    protected function getResponseBody(ResponseInterface $response): array
    {
        try {
            return \json_decode($response->getBody()->getContents(), true);
        } catch (\TypeError $exception) {
            return [];
        }
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
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
