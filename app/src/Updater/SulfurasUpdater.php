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
    public function supportsItem(Item $item): bool
    {
        return strcasecmp('Sulfuras, Hand of Ragnaros', $item->name) === 0;
    }

    /**
     * This does nothing
     *
     * @param Item $item
     * @return Item
     */
    public function updateItem(Item $item): Item
    {
        return $item;
    }
}
