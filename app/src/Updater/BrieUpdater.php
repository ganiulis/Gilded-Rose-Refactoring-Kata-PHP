<?php

namespace GildedRose\Updater;

use GildedRose\Item;

class BrieUpdater implements UpdaterInterface
{
    public function updateItem(Item $item): Item
    {
        if ($item->sell_in < 1 && $item->quality < 49) {
            $item->quality += 2;
        } elseif ($item->quality < 50) {
            $item->quality += 1;
        }
        
        $item->sell_in -= 1;

        return $item;
    }
}
