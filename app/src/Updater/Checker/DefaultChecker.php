<?php

namespace GildedRose\Updater\Checker;

use GildedRose\Item;

class DefaultChecker implements CheckerInterface
{
    /**
     * Supports any passed item
     *
     * @param Item $item
     * @return boolean output always equates to true
     */
    public function supports(Item $item): bool
    {
        return true;
    }
    
    /**
     * Checks quality of an Item so number stays within the allowed limits 
     *
     * @param Item $item
     * @return Item
     */
    public function checkQuality(Item $item): Item
    {
        if ($item->quality > 50) {
            $item->quality = 50;
            return $item;
        }

        if ($item->quality < 0) {
            $item->quality = 0;
            return $item;
        }

        return $item;
    }
}
