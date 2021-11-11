<?php

namespace GildedRose\Updater;

use GildedRose\Item;

class SulfurasUpdater implements UpdaterInterface
{
    public function updateItem(Item $item): Item
    {
        return $item;
    }
}
