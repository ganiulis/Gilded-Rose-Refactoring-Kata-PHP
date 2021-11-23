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
        $item->quality -= 1;

        if ($item->sell_in < 1) {
            $item->quality -= 1;
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
