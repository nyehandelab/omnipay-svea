<?php
/**
 * Svea Abstract Request
 */

namespace Nyehandel\Omnipay\Svea\Message;

use Omnipay\Common\ItemBag;
use Nyehandel\Omnipay\Svea\SveaItemBag;
use Psr\Http\Message\ResponseInterface;

/**
 * Svea Abstract Request
 *
 * This class forms the base class for Svea Checkout requests.
 *
 * @link https://nets-devs.isotop.se/nets-easy/en-EU/docs/
 * @link http://paypal.github.io/sdk/
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const API_VERSION = 'v1';

    protected $liveEndpoint = 'https://checkoutapi.svea.com';
    protected $testEndpoint = 'https://checkoutapistage.svea.com';

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

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

    protected function getBaseData()
    {
        return [];
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

    protected function getHeaders(string $data)
    {
        //'Authorization' => $this->getSecretKey(),
        // TODO: Examples does not use base16 (dechex) or lowercase (strtolower), so we might be able to remove them.
        $timestamp = gmdate('Y-m-d H:i');

        $authToken = base64_encode($this->getMerchantId() . ':' .
            hash('sha512', $data . $this->getCheckoutSecret() . $timestamp));

        // $authToken =  base64_encode(
        //     $this->getMerchantId()
        //     . ':'
        //     . strtolower(
        //         hash(
        //             'sha512',
        //             $data
        //             . $this->getCheckoutSecret()
        //             . $timestamp
        //         )
        //     )
        // );
        return [
            'content-type' => 'application/json',
            'Authorization' => 'Svea ' . $authToken,
        ];
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
