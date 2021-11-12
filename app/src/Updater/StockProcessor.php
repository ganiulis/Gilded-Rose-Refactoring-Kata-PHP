<?php

declare(strict_types=1);

namespace GildedRose\Updater;

use Exception;
use GildedRose\Item;
use GildedRose\Updater;

/**
 * Used for updating an array of Items.
 */
class StockProcessor
{
    /**
     * Initializes a list of Updater classes which can manipulate Items.
     * 
     * @param array|null $updaters changes the default list of Updater classes. New list of Updaters must have UpdaterInterface implemented
     */
    public function __construct(array $updaters = null)
    {   
        if ($updaters === null) {
            $this->updaters = [
                new Updater\BackstageUpdater,
                new Updater\BrieUpdater,
                new Updater\ConjuredUpdater,
                new Updater\SulfurasUpdater,
                // add new updater classes here above DefaultUpdater
                new Updater\DefaultUpdater
            ];
        } elseif (!$updaters[0] instanceof UpdaterInterface) {
            throw new Exception('Invalid class parameter for StockProcessor class! Only include objects which implement UpdaterInterface.');
        } else {
            $this->updaters = $updaters;
        }
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
