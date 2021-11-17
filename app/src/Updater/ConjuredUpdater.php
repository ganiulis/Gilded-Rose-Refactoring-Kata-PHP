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

    public function update(Item $item): Item
    {
        $item->quality -= 2;

        if ($item->sell_in < 1) {
            $item->quality -= 2;
        }

        $item->sell_in -= 1;

        return $item;
    }
}
