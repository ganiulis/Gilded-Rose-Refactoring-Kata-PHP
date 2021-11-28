<?php

namespace App\Updater;

use App\Item;

class BackstageUpdater implements UpdaterInterface
{
    /**
     * Performs a case-insensitive check on the Item name
     *
     * @param Item $item
     * @return boolean
     */
    public function supports(Item $item): bool
    {
        return strcasecmp('Backstage passes to a TAFKAL80ETC concert', $item->name) === 0;
    }
    
    public function update(Item $item): Item
    {
        if ($item->sell_in < 1) {
            $item->quality = 0;
            $item->sell_in -= 1;
            return $item;
        }

        $item->quality += 1;

        if ($item->sell_in < 6) {
            $item->quality += 2;
        }

        if ($item->sell_in > 5 && $item->sell_in < 11) {
            $item->quality += 1;
        }

        if ($item->quality > 50) {
            $item->quality = 50;
        } else if ($item->quality < 0) {
            $item->quality = 0;
        }

        $item->sell_in -= 1;

        return $item;
    }
}
