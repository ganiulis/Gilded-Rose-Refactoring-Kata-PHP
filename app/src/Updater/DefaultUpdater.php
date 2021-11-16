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

    private function updateQuality(Item $item): Item
    {
        $item->quality -= 1;

        if ($item->sell_in < 1) {
            $item->quality -= 1;
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
