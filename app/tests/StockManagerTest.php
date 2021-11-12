<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use GildedRose\Item;
use GildedRose\StockManager;
use GildedRose\Updater\StockProcessor;
use PHPUnit\Framework\TestCase;

class StockManagerTest extends TestCase
{
    public function testStockManager(): void
    {
        $days = 5;
        $items = [
            new Item('foo', 0, 3),
            new Item('bar', 1, 2),
            new Item('zim', 2, 1),
            new Item('gir', 3, 0),
            new Item('dib', 4, -1)
        ];

        $mockStockProcessor = $this->getMockBuilder(StockProcessor::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $mockStockProcessor
            ->expects($this->exactly($days))
            ->method('updateAll')
            ->with($items);

        $stockManager = new StockManager($mockStockProcessor);
        
        ob_start();
        
        $stockManager->process($items, $days);
        
        $output = ob_get_clean();

        Approvals::verifyString($output);
    }
}
