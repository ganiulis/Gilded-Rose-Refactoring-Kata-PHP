<?php

namespace App\Printer;

use App\Entity\Item;

/**
 * Printer class which outputs a receipt of a certain day's stock of Items.
 */
class StockPrinter
{
    /**
     * OMGHAI!
     *
     * @param string $intro changes default OMGHAI! into a different string
     * @return void
     */
    public function printIntro(string $intro = 'OMGHAI!'): void
    {
        echo $intro . PHP_EOL;
    }
    
    private function printItem(Item $item): void
    {
        echo $item . PHP_EOL;
    }

    /**
     * Prints a summary of a certain day's Items.
     *
     * @param array $items array must be a list of Item classes
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
}
