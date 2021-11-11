<?php

namespace GildedRose\Updater;

use GildedRose\Item;

class ConjuredUpdater implements UpdaterInterface
{
    public function updateItem(Item $item): Item
    {
        if ($item->sell_in < 1) {
            if ($item->quality > 3) {
                $item->quality -= 4;
            } elseif ($item->quality > 0) {
                $item->quality = 0;
            }
        } elseif ($item->quality > 1) {
            $item->quality -= 2;
        } elseif ($item->quality > 0) {
            $item->quality -= 1;
        }
        
        $item->sell_in -= 1;

        return $item;
    }
}
