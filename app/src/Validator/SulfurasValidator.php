<?php

namespace GildedRose\Validator;

use GildedRose\Item;
use GildedRose\Validator\ValidatorInterface;

class SulfurasValidator implements ValidatorInterface
{
    /**
     * Performs a case-insensitive check on the Item name
     *
     * @param Item $item
     * @return boolean
     */
    public function supports(Item $item): bool
    {
        return strcasecmp('Sulfuras, Hand of Ragnaros', $item->name) === 0;
    }

    /**
     * Checks quality of an Item so number stays within the allowed limits 
     *
     * @param Item $item
     * @return Item
     */
    public function validate(Item $item): Item
    {
        if ($item->quality !== 80) {
            $item->quality = 80;
        }
        return $item;
    }
}
