<?php

namespace App\Updater;

use App\Entity\Item;

class BrieUpdater implements UpdaterInterface
{
    /**
     * Performs a case-insensitive check on the Item name
     *
     * @param Item $item
     * @return boolean
     */
    public function supports(Item $item): bool
    {
        return strcasecmp('Aged Brie', $item->getName()) == 0;
    }

    public function update(Item $item): Item
    {
        $quality = $item->getQuality();
        $sell_in = $item->getSellIn();

        $quality += 1;
        
        if ($sell_in < 1) {
            $quality += 1;
        }

        if ($quality > 50) {
            $quality = 50;
        } else if ($quality < 0) {
            $quality = 0;
        }

        $sell_in -= 1;

        $item->setQuality($quality);
        $item->setSellIn($sell_in);

        return $item;
    }
}
