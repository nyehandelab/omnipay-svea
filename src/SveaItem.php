<?php
/**
 * Svea Item
 */

namespace Nyehandel\Omnipay\Svea;

use Omnipay\Common\Item;

/**
 * Class SveaItem
 *
 * @package Omnipay\Svea
 */
class SveaItem extends Item
{
    /**
     * {@inheritDoc}
     */
    public function getArticleNumber()
    {
        return $this->getParameter('articleNumber');
    }

    /**
     * Set the item article number
     */
    public function setArticleNumber($value)
    {
        return $this->setParameter('articleNumber', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getUnit()
    {
        return $this->getParameter('unit');
    }

    /**
     * Set the item unit
     */
    public function setUnit($value)
    {
        return $this->setParameter('unit', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getVatPercent()
    {
        return $this->getParameter('vatPercent');
    }

    /**
     * Set the item vat percent
     */
    public function setVatPercent($value)
    {
        return $this->setParameter('vatPercent', $value);
    }

    public function getDiscountAmount()
    {
        return $this->getParameter('discountAmount');
    }

    public function setDiscountAmount($value)
    {
        return $this->setParameter('discountAmount', $value);
    }

    public function getDiscountPercent()
    {
        return $this->getParameter('discountPercent');
    }

    public function setDiscountPercent($value)
    {
        return $this->setParameter('discountPercent', $value);
    }

    public function getMerchantData()
    {
        return $this->getParameter('merchantData');
    }

    public function setMerchantData($value)
    {

        return $this->setParameter('merchantData', $value);
    }

    public function getTaxAmount(): int
    {
        return (int) $this->getPrice() * $this->getVatPercent() / (100 * 100);
    }

    public function getNetTotalAmount(): int
    {
        return (int) $this->getPrice() * $this->getQuantity();
    }
}
