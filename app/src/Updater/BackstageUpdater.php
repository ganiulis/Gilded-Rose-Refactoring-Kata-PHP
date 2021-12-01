<?php

namespace App\Updater;

use App\Entity\Item;

class BackstageUpdater implements UpdaterInterface
{
    /**
     * Performs a case-insensitive check on the Item name.
     *
     * @param Item $item
     * @return boolean
     */
    public function supports(Item $item): bool
    {
        return strcasecmp('Backstage passes to a TAFKAL80ETC concert', $item->getName()) == 0;
    }
    
    public function update(Item $item): Item
    {
        $quality = $item->getQuality();
        $sell_in = $item->getSellIn();

        if ($sell_in < 1) {
            $quality = 0;
            $sell_in -= 1;

            $item->setQuality($quality);
            $item->setSellIn($sell_in);

            return $item;
        }

        $quality += 1;

        if ($sell_in < 6) {
            $quality += 2;
        }

        if ($sell_in > 5 && $sell_in < 11) {
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
