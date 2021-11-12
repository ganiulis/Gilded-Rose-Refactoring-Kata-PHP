<?php

declare(strict_types=1);

namespace GildedRose\Updater;

use GildedRose\Item;
use GildedRose\Updater;

/**
 * Used for updating an array of Items.
 */
class StockProcessor
{
    /**
     * Initializes a list of Updater classes before Items are to be updated
     */
    public function __construct()
    {
        $this->updaters = [
            new Updater\BackstageUpdater,
            new Updater\BrieUpdater,
            new Updater\ConjuredUpdater,
            new Updater\SulfurasUpdater,
            // add new updater classes here above DefaultUpdater
            new Updater\DefaultUpdater
        ];
    }

    /**
     * Cycles through all updater classes until the correct one is selected and updates Item data
     *
     * @param Item $item
     * @return void
     */
    private function update(Item $item): void
    {
        foreach ($this->updaters as $updater) {
            if ($updater->supports($item)) {
                $updater->update($item);
                break;
            }
        }
    }

    /**
     * Updates quality of selected array of Items
     *
     * @param array $items Items array to be updated
     * @return array updated Items array
     */
    public function updateAll(array $items): array
    {
        foreach ($items as $item) {
            $this->update($item);
        }
        return $items;
    }
}
