<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /**
     * @dataProvider provideItemData
     */
    public function testItem(array $testData): void
    {
        $itemTest = new Item(
            $testData['Name'],
            $testData['SellIn']['test'],
            $testData['Quality']['test']
        );

        $itemExpected = new Item(
            $testData['Name'],
            $testData['SellIn']['expected'],
            $testData['Quality']['expected']
        );

        $gildedRose = new GildedRose([$itemTest]);
        
        $gildedRose->updateQuality();

        $this->assertEquals($itemExpected, $itemTest, "Something is wrong with the tested items' data input! Or with the logic within the GildedRose.php src file.");
    }

    public function provideItemData(): array 
    {
        return [
            [
                'Typical item - SellIn and Quality both drop by 1' => [
                    'Name' => 'Mana Cake',        
                    'SellIn' => ['test' => 5, 'expected' => 4],
                    'Quality' => ['test' => 5, 'expected' => 4]
                ]
            ],
            [
                'Conjured item - Quality drops by 2 when SellIn drops by 1' => [
                    'Name' => 'Conjured Cake',    
                    'SellIn' => ['test' => 5, 'expected' => 4],
                    'Quality' => ['test' => 5, 'expected' => 3]
                ]
            ],
            [
                'Regex test for Nonconjured item - SellIn and Quality both drop by 1' => [
                    'Name' => 'Nonconjured Cake', 
                    'SellIn' => ['test' => 5, 'expected' => 4],
                    'Quality' => ['test' => 5, 'expected' => 4]
                ]
            ],
            [
                'Typical item - drops in Quality by 2 when updated SellIn becomes negative' => [
                    'Name' => 'Water',
                    'SellIn' => ['test' => 0, 'expected' => -1],
                    'Quality' => ['test' => 5, 'expected' => 3]
                ]
            ],
            [
                'Typical item - drops in Quality by 2 when updated SellIn is already negative' => [
                    'Name' => 'Water',
                    'SellIn' => ['test' => -1, 'expected' => -2],
                    'Quality' => ['test' => 5, 'expected' => 3]
                ]
            ],
            [
                'Sulfuras - does not change' => [
                    'Name' => 'Sulfuras, Hand of Ragnaros',    
                    'SellIn' => ['test' => 0, 'expected' => 0],
                    'Quality' => ['test' => 80, 'expected' => 80]
                ]
            ],
            [
                'Conjured item - drops in Quality by 4 when updated SellIn becomes negative' => [
                    'Name' => 'Conjured Cake',    
                    'SellIn' => ['test' => 0, 'expected' => -1],
                    'Quality' => ['test' => 5, 'expected' => 1]
                ]
            ],
            [
                'Conjured item - drops in Quality by 4 when updated SellIn is already negative' => [
                    'Name' => 'Conjured Cake',    
                    'SellIn' => ['test' => -1, 'expected' => -2],
                    'Quality' => ['test' => 5, 'expected' => 1]
                ]
            ],
            [
                'Conjured item - drops in Quality to zero' => [
                    'Name' => 'Conjured Cake',    
                    'SellIn' => ['test' => -1, 'expected' => -2],
                    'Quality' => ['test' => 3, 'expected' => 0]
                ]
            ]
        ];
    }
}
