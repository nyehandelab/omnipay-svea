<?php
/**
 * Svea Item bag
 */

namespace Nyehandel\Omnipay\Svea;

use Omnipay\Common\ItemBag;
use Omnipay\Common\ItemInterface;

/**
 * Class SveaItemBag
 *
 * @package Omnipay\Svea
 */
class SveaItemBag extends ItemBag
{
    /**
     * Add an item to the bag
     *
     * @see Item
     *
     * @param ItemInterface|array $item An existing item, or associative array of item parameters
     */
    public function add($item)
    {
        if ($item instanceof ItemInterface) {
            $this->items[] = $item;
        } else {
            $this->items[] = new SveaItem($item);
        }
    }
}
