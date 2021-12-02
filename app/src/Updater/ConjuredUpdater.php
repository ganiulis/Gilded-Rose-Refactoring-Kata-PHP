<?php

namespace App\Updater;

use App\Entity\Item;

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
        return preg_match('/\bConjured\b/i', $item->getName());
    }

    public function update(Item $item): Item
    {
        $quality = $item->getQuality();
        $sell_in = $item->getSellIn();

        $quality -= 2;

        if ($sell_in < 1) {
            $quality -= 2;
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
