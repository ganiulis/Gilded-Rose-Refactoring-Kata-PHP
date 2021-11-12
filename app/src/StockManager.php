<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item;
use GildedRose\Updater;
use GildedRose\Updater\UpdaterInterface;

/**
 * Used for updating an array of Items.
 */
class StockManager
{
    /**
     * Initializes a list of Updater classes which can manipulate Items.
     */
    public function __construct()
    {   
        $this->defaultUpdater = new Updater\DefaultUpdater;

        $updaters = [
            'Backstage passes to a TAFKAL80ETC concert' => new Updater\BackstageUpdater,
            'Aged Brie' => new Updater\BrieUpdater,
            'Any Conjured item' => new Updater\ConjuredUpdater,
            'Sulfuras, Hand of Ragnaros' => new Updater\SulfurasUpdater
            // add new updater classes here
        ];

        foreach (array_values($updaters) as $updater) {
            $this->addUpdater($updater);
        }
    }

    private function addUpdater(UpdaterInterface $updaterInterface): void
    {
        $this->updaters[] = $updaterInterface;
    }

    /**
     * Cycles through all non-default Updater classes until the correct one is selected and updates Item data.
     *
     * @param Item $item
     * @return boolean returns false if no Updater was found
     */
    private function update(Item $item): bool
    {
        foreach ($this->updaters as $updater) {
            if ($updater->supports($item)) {
                $updater->update($item);
                return true;
            }
        }
        return false;
    }

    /**
     * Updates quality of selected array of Items. Checks through non-default Updaters first before calling DefaultUpdater.
     *
     * @param array $items Items array to be updated
     * @return array updated Items array
     */
    public function updateAll(array $items): array
    {
        foreach ($items as $item) {
            if(!$this->update($item)) {
                $this->defaultUpdater->update($item);
            };
        }
        return $items;
    }
}
