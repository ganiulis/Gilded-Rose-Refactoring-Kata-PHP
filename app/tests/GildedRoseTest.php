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

        $gildedRose = new GildedRose();
        
        $gildedRose->updateItems([$itemTest]);

        $this->assertEquals($itemExpected, $itemTest, "Something is wrong with the tested items' data input! Or with the logic within the GildedRose.php src file.");
    }

    public function provideItemData(): array 
    {
        return [
            [
                'Typical Item' => [
                    'Name' => 'Mana Cake',        
                    'SellIn' => ['test' => 5, 'expected' => 4],
                    'Quality' => ['test' => 5, 'expected' => 4]
                ]
            ],
            [
                'Backstage Passes Item' => [
                    'Name' => 'Mana Cake',        
                    'SellIn' => ['test' => 5, 'expected' => 4],
                    'Quality' => ['test' => 5, 'expected' => 4]
                ]
            ],
            [
                'Aged Brie Item' => [
                    'Name' => 'Mana Cake',        
                    'SellIn' => ['test' => 5, 'expected' => 4],
                    'Quality' => ['test' => 5, 'expected' => 4]
                ]
            ],
            [
                'Conjured Item' => [
                    'Name' => 'Mana Cake',        
                    'SellIn' => ['test' => 5, 'expected' => 4],
                    'Quality' => ['test' => 5, 'expected' => 4]
                ]
            ],
            [
                'Nonconjured Item' => [
                    'Name' => 'Mana Cake',        
                    'SellIn' => ['test' => 5, 'expected' => 4],
                    'Quality' => ['test' => 5, 'expected' => 4]
                ]
            ],
            [
                'Sulfuras Item' => [
                    'Name' => 'Mana Cake',        
                    'SellIn' => ['test' => 5, 'expected' => 4],
                    'Quality' => ['test' => 5, 'expected' => 4]
                ]
            ],
        ];
    }
}
