<?php

namespace App\Updater;

use App\Entity\Item;

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

    public function update(Item $item): Item
    {
        $quality = $item->getQuality();
        $sell_in = $item->getSellIn();

        $quality -= 1;

        if ($sell_in < 1) {
            $quality -= 1;
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
