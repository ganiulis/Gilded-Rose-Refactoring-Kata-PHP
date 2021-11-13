<?php

namespace GildedRose\Printer;

use GildedRose\Item;

/**
 * Printer class which outputs a receipt of a certain day's stock of Items
 */
class StockPrinter
{
    /**
     * OMGHAI!
     *
     * @return void
     */
    public function printIntro(): void
    {
        echo 'OMGHAI!' . PHP_EOL;
    }

    /**
     * Prints a summary of Items
     *
     * @param array $items must be of Item class
     * @param integer $day the day of the receipt
     * @return void
     */
    public function printSummary(array $items, int $day): void
    {
        echo "-------- day ${day} --------" . PHP_EOL;
        echo 'name, sellIn, quality' . PHP_EOL;
        foreach ($items as $item) {
            $this->printItem($item);
        }
        echo PHP_EOL;
    }

    private function printItem(Item $item): void
    {
        echo $item . PHP_EOL;
    }
}
