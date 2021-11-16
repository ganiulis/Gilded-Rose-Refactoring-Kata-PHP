<?php

declare(strict_types=1);

namespace Tests\Updater;

use GildedRose\Item;
use GildedRose\Updater\DefaultUpdater;
use PHPUnit\Framework\TestCase;

/**
 * Tests DefaultUpdater behaviour
 */
class DefaultUpdaterTest extends TestCase
{
    /**
     * @dataProvider provideTestItemData
    */
   public function testDefaultUpdater(array $testItemData): void
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

    $updater = new DefaultUpdater();
    
    $updater->update($actualItem);

    $this->assertEquals($expectedItem, $actualItem, 'Actual and expected items do not match after passing through DefaultUpdater!');

   }

   public function provideTestItemData(): array 
   {
       return [
           [
               'First test' => [
                   'Name' => 'Apple pie',        
                   'SellIn' => ['actual' => 2, 'expected' => 1],
                   'Quality' => ['actual' => 2, 'expected' => 1]
               ]
           ],
           [
               'Second test' => [
                   'Name' => 'Banana pie', 
                   'SellIn' => ['actual' => 1, 'expected' => 0],
                   'Quality' => ['actual' => 2, 'expected' => 1]
               ]
           ],
           [
               'Third test' => [
                   'Name' => 'Cherry pie',
                   'SellIn' => ['actual' => 0, 'expected' => -1],
                   'Quality' => ['actual' => 2, 'expected' => 0]
               ]
           ],
           [
               'Fourth test' => [
                   'Name' => 'Date pie',
                   'SellIn' => ['actual' => 0, 'expected' => -1],
                   'Quality' => ['actual' => 1, 'expected' => 0]
               ]
            ],
            [
                'Fifth test' => [
                    'Name' => 'Elderberry pie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 0, 'expected' => 0]
                ]
             ],
             [
                 'Sixth test' => [
                     'Name' => 'Fig pie',
                     'SellIn' => ['actual' => -1, 'expected' => -2],
                     'Quality' => ['actual' => 0, 'expected' => 0]
                 ]
              ]
       ];
   }
}
