<?php

namespace GildedRose\Updater;

use GildedRose\Item;

class SulfurasUpdater implements UpdaterInterface
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
     * This does nothing
     *
     * @param Item $item
     * @return Item
     */
    public function update(Item $item): Item
    {
        return $item;
    }
}
