<?php

namespace GildedRose\Updater;

use GildedRose\Item;

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

    private function updateQuality(Item $item): Item
    {
        if ($item->sell_in < 1) {
            $item->quality = 0;
            return $item;
        }

        $item->quality += 1;

        if ($item->sell_in < 6) {
            $item->quality += 2;
        }

        if ($item->sell_in > 5 && $item->sell_in < 11) {
            $item->quality += 1;
        }

        return $item;
    }

    private function updateSellIn(Item $item): Item
    {
        $item->sell_in -= 1;
        return $item;
    }
    
    public function update(Item $item): Item
    {
        $this->updateQuality($item);
        $this->updateSellIn($item);
        return $item;
    }
}
