<?php

namespace App\Tests\Printer;

use App\Entity\Item;
use ApprovalTests\Approvals;
use App\Printer\StockPrinter;
use PHPUnit\Framework\TestCase;

class StockPrinterTest extends TestCase
{
    protected function setUp(): void
    {
        $this->printer = new StockPrinter();

        ob_start();
    }

    protected function tearDown(): void
    {
        ob_end_clean();
    }

    public function testDefaultIntro(): void
    {
        $this->printer->printIntro();

        $output = ob_get_contents();

        Approvals::verifyString($output);
    }

    public function testCustomIntro(): void
    {
        $this->printer->printIntro('Hello, world! This is a custom intro.');

        $output = ob_get_contents();

        Approvals::verifyString($output);
    }

    public function testSummary(): void
    {
        $itemsData = [
            [
                'name' => 'alpha',
                'sellIn' => 5,
                'quality' => 0
            ],
            [
                'name' => 'bravo',
                'sellIn' => 4,
                'quality' => 1
            ],
            [
                'name' => 'charlie',
                'sellIn' => 3,
                'quality' => 2
            ],
            [
                'name' => 'delta',
                'sellIn' => 2,
                'quality' => 3
            ],
            [
                'name' => 'echo',
                'sellIn' => 1,
                'quality' => 4
            ],
            [
                'name' => 'foxtrot',
                'sellIn' => 0,
                'quality' => 5
            ]
        ];

        foreach ($itemsData as $itemData) {
            $item = new Item();

            $item->setName($itemData['name']);
            $item->setSellIn($itemData['sellIn']);
            $item->setQuality($itemData['quality']);

            $items[] = $item;
        }

        $this->printer->printSummary($items, 4321);

        $output = ob_get_contents();

        Approvals::verifyString($output);
    }

    public function testEmptySummary(): void
    {
        $this->printer->printSummary([], 1234);
        
        $output = ob_get_contents();

        Approvals::verifyString($output);
    }
}
