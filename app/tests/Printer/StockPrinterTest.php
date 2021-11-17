<?php

namespace Tests\Printer;

use ApprovalTests\Approvals;
use GildedRose\Item;
use GildedRose\Printer\StockPrinter;
use PHPUnit\Framework\TestCase;

class StockPrinterTest extends TestCase
{
    public function testStockPrinter(): void
    {
        $printer = new StockPrinter();

        $testItems = [
            new Item('foo', 4, 3),
            new Item('bar', 5, 2),
            new Item('zim', 6, 1),
            new Item('gir', 7, 0)
        ];
        
        ob_start();

        $printer->printIntro();

        $printer->printSummary($testItems, 3);
        
        $output = ob_get_contents();

        Approvals::verifyString($output);

        ob_end_clean();
    }
}
