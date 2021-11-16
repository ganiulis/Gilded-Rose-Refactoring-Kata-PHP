<?php

namespace GildedRose\Updater;

use GildedRose\Item;

class BrieUpdater implements UpdaterInterface
{
    /**
     * Performs a case-insensitive check on the Item name
     *
     * @param Item $item
     * @return boolean
     */
    public function supports(Item $item): bool
    {
        return strcasecmp('Aged Brie', $item->name) === 0;
    }

    public function update(Item $item): Item
    {
        $item->quality += 1;
        
        if ($item->sell_in < 1) {
            $item->quality += 1;
        }

        $item->sell_in -= 1;

        return $item;
    }
}
