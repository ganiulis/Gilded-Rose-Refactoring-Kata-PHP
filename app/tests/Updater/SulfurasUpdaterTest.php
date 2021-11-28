<?php

declare(strict_types=1);

namespace Tests\GildedRose\Updater;

use GildedRose\Item;
use GildedRose\Updater\SulfurasUpdater;
use PHPUnit\Framework\TestCase;

/**
 * Tests SulfurasUpdater behaviour
 */
class SulfurasTest extends TestCase
{
    /**
     * @dataProvider provideTestItemData
    */
   public function testSulfurasUpdater(array $testItemData): void
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

    $updater = new SulfurasUpdater();

    $this->assertTrue($updater->supports($actualItem));
    
    $updater->update($actualItem);

    $this->assertEquals($expectedItem, $actualItem, 'Actual and expected items do not match after passing through SulfurasUpdater!');

   }

   public function provideTestItemData(): array 
   {
       return [
           [
               'First test' => [
                   'Name' => 'Sulfuras, Hand of Ragnaros',        
                   'SellIn' => ['actual' => 1, 'expected' => 1],
                   'Quality' => ['actual' => 80, 'expected' => 80]
               ]
           ],
           [
               'Second test' => [
                   'Name' => 'Sulfuras, Hand of Ragnaros', 
                   'SellIn' => ['actual' => 0, 'expected' => 0],
                   'Quality' => ['actual' => 80, 'expected' => 80]
               ]
           ],
           [
               'Third test' => [
                   'Name' => 'Sulfuras, Hand of Ragnaros',
                   'SellIn' => ['actual' => -1, 'expected' => -1],
                   'Quality' => ['actual' => 80, 'expected' => 80]
               ]
           ]
       ];
   }
}
