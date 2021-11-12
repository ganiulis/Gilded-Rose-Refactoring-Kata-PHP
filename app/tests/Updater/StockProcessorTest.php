<?php 

namespace Tests\Updater;

use GildedRose\Item;
use GildedRose\Updater\ConjuredUpdater;
use GildedRose\Updater\StockProcessor;
use PHPUnit\Framework\TestCase;

class StockProcesssorTest extends TestCase
{
    public function testUpdateAll(): void
    {
        $processor = new StockProcessor();

        $testItems = $this->provideItems();

        $actualItems = [];
        $expectedItems = [];

        foreach ($testItems as $testItem) {
            $actualItems[] = new Item(
                $testItem['Name'],
                $testItem['SellIn']['actual'],
                $testItem['Quality']['actual']
            );
            
            $expectedItems[] = new Item(
                $testItem['Name'],
                $testItem['SellIn']['expected'],
                $testItem['Quality']['expected']
            );
        }

        $processor->updateAll($actualItems);

        $this->assertEquals($expectedItems, $actualItems, 'Actual and expected items do not match after passing through StockProcessor!');
    }

    private function provideItems(): array 
    {
        return [
            [
                'Name' => 'Apple pie',        
                'SellIn' => ['actual' => 2, 'expected' => 1],
                'Quality' => ['actual' => 2, 'expected' => 1]
            ],
            [
                'Name' => 'Conjured banana pie', 
                'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 4, 'expected' => 2]
            ],
            [
                'Name' => 'Cherry nonconjured pie',
                'SellIn' => ['actual' => 2, 'expected' => 1],
                'Quality' => ['actual' => 2, 'expected' => 1]
            ],
            [
                'Name' => 'Aged brie',
                'SellIn' => ['actual' => 0, 'expected' => -1],
                'Quality' => ['actual' => 0, 'expected' => 2]
            ],
            [
                'Name' => 'Sulfuras, Hand of Ragnaros',
                'SellIn' => ['actual' => 1, 'expected' => 1],
                'Quality' => ['actual' => 80, 'expected' => 80]
            ],
            [
                'Name' => 'Backstage passes to a TAFKAL80ETC concert',
                'SellIn' => ['actual' => 10, 'expected' => 9],
                'Quality' => ['actual' => 48, 'expected' => 50]
            ]
        ];
    }
}
