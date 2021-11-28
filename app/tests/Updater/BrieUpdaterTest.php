<?php

declare(strict_types=1);

namespace Tests\GildedRose\Updater;

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

    $this->assertTrue($updater->supports($actualItem));
    
    $updater->update($actualItem);

    $this->assertEquals($expectedItem, $actualItem, 'Actual and expected items do not match after passing through BrieUpdater!');
   }

   public function provideTestItemData(): array 
   {
       return [
           [
               'Quality increases by 1' => [
                   'Name' => 'Aged brie',        
                   'SellIn' => ['actual' => 2, 'expected' => 1],
                   'Quality' => ['actual' => 2, 'expected' => 3]
               ]
           ],
           [
               'Quality increases by 1' => [
                   'Name' => 'Aged brie', 
                   'SellIn' => ['actual' => 1, 'expected' => 0],
                   'Quality' => ['actual' => 2, 'expected' => 3]
               ]
           ],
           [
               'Quality increases by 2 when SellIn is negative' => [
                   'Name' => 'Aged brie',
                   'SellIn' => ['actual' => 0, 'expected' => -1],
                   'Quality' => ['actual' => 2, 'expected' => 4]
               ]
           ]
       ];
   }
}
