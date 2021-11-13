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
     * 
     * @param boolean $flushUpdaters flushes original list of updaters so that only customUpdaters and DefaultUpdater class are left. $flushUpdaters is useful when you want to test out StockManager with a specific list of Updater classes
     * @param array|null $customUpdaters to add any additional or custom Updater classes to the list of Updaters
     */
    public function __construct(bool $flushUpdaters = false, array $customUpdaters = null)
    {   
        $this->defaultUpdater = new Updater\DefaultUpdater;

        if (!$flushUpdaters) {
            $this->addUpdaters([
                'Backstage passes to a TAFKAL80ETC concert' => new Updater\BackstageUpdater,
                'Aged Brie' => new Updater\BrieUpdater,
                'Any Conjured item' => new Updater\ConjuredUpdater,
                'Sulfuras, Hand of Ragnaros' => new Updater\SulfurasUpdater
                // add new updater classes here
            ]);
        }

        if(isset($customUpdaters)) {
            $this->addUpdaters($customUpdaters);
        }
    }

    private function addUpdaters(array $updaters): void
    {
        foreach (array_values($updaters) as $updater) {
            $this->addUpdater($updater);
        }
    }

    private function addUpdater(UpdaterInterface $updaterInterface): void
    {
        $this->updaters[] = $updaterInterface;
    }

    private function update(Item $item): void
    {
        if (isset($this->updaters)) {
            foreach ($this->updaters as $updater) {
                if ($updater->supports($item)) {
                    $updater->update($item);
                    return;
                }
            }
        }
        $this->defaultUpdater->update($item);
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
            $this->update($item);
        }
        return $items;
    }
}
