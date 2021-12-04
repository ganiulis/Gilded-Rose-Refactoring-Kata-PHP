<?php

namespace App\Tests\Printer;

use App\Entity\Item;
use ApprovalTests\Approvals;
use App\Printer\StockPrinter;
use PHPUnit\Framework\TestCase;

class StockPrinterTest extends TestCase
{
    public function testDefaultIntro(): void
    {
        $printer = new StockPrinter();

        ob_start();
        
        $printer->printIntro();

        $output = ob_get_contents();

        ob_end_clean();

        Approvals::verifyString($output);
    }

    public function testCustomIntro(): void
    {
        $printer = new StockPrinter();

        ob_start();
        
        $printer->printIntro('Hello, world! This is a custom intro.');

        $output = ob_get_contents();

        ob_end_clean();

        Approvals::verifyString($output);
    }

    public function testSummary(): void
    {
        $itemsData = [
            [
                'name' => 'alpha',
                'sell_in' => 5,
                'quality' => 0
            ],
            [
                'name' => 'bravo',
                'sell_in' => 4,
                'quality' => 1
            ],
            [
                'name' => 'charlie',
                'sell_in' => 3,
                'quality' => 2
            ],
            [
                'name' => 'delta',
                'sell_in' => 2,
                'quality' => 3
            ],
            [
                'name' => 'echo',
                'sell_in' => 1,
                'quality' => 4
            ],
            [
                'name' => 'foxtrot',
                'sell_in' => 0,
                'quality' => 5
            ]
        ];

        foreach ($itemsData as $itemData) {
            $item = new Item();

            $item->setName($itemData['name']);
            $item->setSellIn($itemData['sell_in']);
            $item->setQuality($itemData['quality']);

            $items[] = $item;
        }

        $printer = new StockPrinter();

        ob_start();

        $printer->printSummary($items, 4321);

        $output = ob_get_contents();

        ob_end_clean();

        Approvals::verifyString($output);
    }

    public function testEmptySummary(): void
    {
        $printer = new StockPrinter();

        ob_start();

        $printer->printSummary([], 1234);
        
        $output = ob_get_contents();

        ob_end_clean();

        Approvals::verifyString($output);
    }
}
