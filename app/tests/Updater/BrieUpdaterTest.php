<?php

declare(strict_types=1);

namespace Tests\Updater;

use GildedRose\Item;
use GildedRose\Updater\BrieUpdater;
use PHPUnit\Framework\TestCase;

/**
 * Tests BrieUpdater behaviour
 */
class BrieUpdaterTest extends TestCase
{
    /**
     * @dataProvider provideTestItemData
    */
   public function testBrieUpdater(array $testItemData): void
   {
    $actualItem = new Item(
        $testItemData['Name'],
        $testItemData['SellIn']['actual'],
        $testItemData['Quality']['actual']
    );

    $expectedItem = new Item(
        $testItemData['Name'],
        $testItemData['SellIn']['expected'],
        $testItemData['Quality']['expected']
    );

    $updater = new BrieUpdater();
    
    $updater->update($actualItem);

    $this->assertEquals($expectedItem, $actualItem, 'Actual and expected items do not match after passing through BrieUpdater!');
   }

   public function provideTestItemData(): array 
   {
       return [
           [
               'First test' => [
                   'Name' => 'Aged brie',        
                   'SellIn' => ['actual' => 2, 'expected' => 1],
                   'Quality' => ['actual' => 2, 'expected' => 3]
               ]
           ],
           [
               'Second test' => [
                   'Name' => 'Aged brie', 
                   'SellIn' => ['actual' => 1, 'expected' => 0],
                   'Quality' => ['actual' => 2, 'expected' => 3]
               ]
           ],
           [
               'Third test' => [
                   'Name' => 'Aged brie',
                   'SellIn' => ['actual' => 0, 'expected' => -1],
                   'Quality' => ['actual' => 2, 'expected' => 4]
               ]
           ],
           [
               'Fourth test' => [
                   'Name' => 'Aged brie',
                   'SellIn' => ['actual' => 0, 'expected' => -1],
                   'Quality' => ['actual' => 0, 'expected' => 2]
               ]
            ],
            [
                'Fifth test' => [
                    'Name' => 'Aged brie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 47, 'expected' => 49]
                ]
            ],
            [
                'Sixth test' => [
                    'Name' => 'Aged brie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 48, 'expected' => 50]
                ]
            ],
            [
                'Seventh test' => [
                    'Name' => 'Aged brie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 49, 'expected' => 50]
                ]
            ],
            [
                'Eight test' => [
                    'Name' => 'Aged brie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 50, 'expected' => 50]
                ]
            ],
            [
                'Ninth test' => [
                    'Name' => 'Aged brie',
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 48, 'expected' => 49]
                ]
            ],
            [
                'Tenth test' => [
                    'Name' => 'Aged brie',
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 49, 'expected' => 50]
                ]
            ],
            [
                'Eleventh test' => [
                    'Name' => 'Aged brie',
                    'SellIn' => ['actual' => 1, 'expected' => 0],
                    'Quality' => ['actual' => 50, 'expected' => 50]
                ]
            ]
       ];
   }
}
