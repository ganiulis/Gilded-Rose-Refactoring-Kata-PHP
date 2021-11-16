<?php

namespace GildedRose\Updater;

use GildedRose\Item;

class DefaultUpdater implements UpdaterInterface
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

    public function update(Item $item): Item
    {
        if ($item->sell_in < 1 && $item->quality > 1) {
            $item->quality -= 2;
        } elseif ($item->quality > 0) {
            $item->quality -= 1;
        }
        
        $item->sell_in -= 1;

        return $item;
    }
}
