<?php

namespace GildedRose;

use GildedRose\Updater\StockProcessor;

/**
 * Processes Items with the given processor class.
 * 
 * Currently only supports the GildedRose class with updateQuality method.
 */
class StockManager
{
    public function __construct(StockProcessor $stockProcessor)
    {
        $this->stockProcessor = $stockProcessor;
    }

    /**
     * processes and prints out Item types with the help of the GildedRose class
     *
     * @param array $items the array of items, must be of Item class
     * @param integer $days hoow many days will the item be updated for
     * @return void the processor currently only prints out items in a list-like format
     */
    public function process(array $items, int $days = 2): void
    {
        echo 'OMGHAI!' . PHP_EOL;

        for ($i = 0; $i < $days; $i++) {
            echo "-------- day ${i} --------" . PHP_EOL;
            echo 'name, sellIn, quality' . PHP_EOL;
            foreach ($items as $item) {
                echo $item . PHP_EOL;
            }
            echo PHP_EOL;
            $this->stockProcessor->updateAll($items);
        }
    }
}
