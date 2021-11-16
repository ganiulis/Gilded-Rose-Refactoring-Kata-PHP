<?php

namespace GildedRose\Updater;

use GildedRose\Item;

class ConjuredUpdater implements UpdaterInterface
{
    /**
     * Checks for Conjured in item name
     *
     * @param Item $item
     * @return boolean returns true if `conjured` is found in Item name
     */
    public function supports(Item $item): bool
    {
        return preg_match('/\bConjured\b/i', $item->name);
    }

    private function updateQuality(Item $item): Item
    {
        $item->quality -= 2;

        if ($item->sell_in < 1) {
            $item->quality -= 2;
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
