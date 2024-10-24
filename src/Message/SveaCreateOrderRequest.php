<?php

namespace Nyehandel\Omnipay\Svea\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Svea Checkout Authorize Request
 */
class SveaCreateOrderRequest extends AbstractCheckoutOrderRequest
{
    public function getData()
    {
        $this->validate(
            'items',
            'currency',
            'countryCode',
            'locale',
            'clientOrderNumber',
            'checkoutUri',
            'confirmationUri',
            'termsUri',
            'pushUri',
        );

        $data = [
            'countryCode' => $this->getCountryCode(),
            'locale' => $this->getLocale(),
            'currency' => $this->getCurrency(),
            'clientOrderNumber' => $this->getClientOrderNumber(),
            'merchantSettings' => [
                'CheckoutUri' => $this->getCheckoutUri(),
                'ConfirmationUri' => $this->getConfirmationUri(),
                'TermsUri' => $this->getTermsUri(),
                'PushUri' => $this->getPushUri(),
                'CheckoutValidationCallBackUri' => $this->getCheckoutValidationCallBackUri(),
                'ActivePartPaymentCampaigns' => $this->getActivePartPaymentCampaigns(),
                'PromotedPartPaymentCampaign' => $this->getPromotedPartPaymentCampaign(),
            ],
            'cart' => $this->getCartData(),
            'presetValues' => $this->getPresetValues(),
            'requireElectronicIdAuthentication' => $this->getRequireElectronicIdAuthentication(),
            'partnerKey' => $this->getPartnerKey(),
            'merchantData' => $this->getMerchantData(),
        ];

        return $data;
    }

    public function setCountryCode($value)
    {
        return $this->setParameter('countryCode', $value);
    }

    public function getCountryCode()
    {
        return $this->getParameter('countryCode');
    }

    public function setLocale($value)
    {
        return $this->setParameter('locale', $value);
    }

    public function getLocale()
    {
        return $this->getParameter('locale');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function setClientOrderNumber($value)
    {
        return $this->setParameter('clientOrderNumber', $value);
    }

    public function getClientOrderNumber()
    {
        return $this->getParameter('clientOrderNumber');
    }

    public function setCheckoutUri($value)
    {
        return $this->setParameter('checkoutUri', $value);
    }

    public function getCheckoutUri()
    {
        return $this->getParameter('checkoutUri');
    }

    public function setConfirmationUri($value)
    {
        return $this->setParameter('confirmationUri', $value);
    }

    public function getConfirmationUri()
    {
        return $this->getParameter('confirmationUri');
    }

    public function setTermsUri($value)
    {
        return $this->setParameter('termsUri', $value);
    }

    public function getTermsUri()
    {
        return $this->getParameter('termsUri');
    }

    public function setPushUri($value)
    {
        return $this->setParameter('pushUri', $value);
    }

    public function getPushUri()
    {
        return $this->getParameter('pushUri');
    }

    public function setCheckoutValidationCallBackUri($value)
    {
        return $this->setParameter('checkoutValidationCallBackUri', $value);
    }

    public function getCheckoutValidationCallBackUri()
    {
        return $this->getParameter('checkoutValidationCallBackUri');
    }

    public function setActivePartPaymentCampaigns($value)
    {
        return $this->setParameter('activePartPaymentCampaigns', $value);
    }

    public function getActivePartPaymentCampaigns()
    {
        return $this->getParameter('activePartPaymentCampaigns');
    }

    public function setPromotedPartPaymentCampaign($value)
    {
        return $this->setParameter('promotedPartPaymentCampaign', $value);
    }

    public function getPromotedPartPaymentCampaign()
    {
        return $this->getParameter('promotedPartPaymentCampaign');
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/api/orders';
    }

    public function setPresetValues($value)
    {
        return $this->setParameter('presetValues', $value);
    }

    public function getPresetValues()
    {
        return $this->getParameter('presetValues');
    }

    public function setRequireElectronicIdAuthentication($value)
    {
        return $this->setParameter('requireElectronicIdAuthentication', $value);
    }

    public function getRequireElectronicIdAuthentication()
    {
        return $this->getParameter('requireElectronicIdAuthentication');
    }

    public function setPartnerKey($value)
    {
        return $this->setParameter('partnerKey', $value);
    }

    public function getPartnerKey()
    {
        return $this->getParameter('partnerKey');
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

        if ($httpResponse->getStatusCode() >= 400) {
            $errorMessage = '';
            $errorResponseBody = $this->getResponseBody($httpResponse);
            $headers = $httpResponse->getHeaders();

            if (count($errorResponseBody)) {
                $errorMessage = $errorResponseBody;
            } else if (array_key_exists('errormessage', $headers)) {
                $errorMessage = $headers['errormessage'];
            } else {
                $errorMessage = 'Undefined error occurred. HTTP status code: ' . $httpResponse->getStatusCode();

            }

            throw new InvalidResponseException(
                \sprintf('Reason: (%s)', json_encode($errorMessage))
            );
        }

        return new SveaCreateOrderResponse(
            $this,
            $this->getResponseBody($httpResponse),
            $httpResponse->getStatusCode()
        );
    }
}
