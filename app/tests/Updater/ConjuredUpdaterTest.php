<?php

declare(strict_types=1);

namespace App\Tests\Updater;

use App\Item;
use App\Updater\ConjuredUpdater;
use PHPUnit\Framework\TestCase;

/**
 * Tests ConjuredUpdater behaviour
 */
class ConjuredUpdaterTest extends TestCase
{
    /**
     * @dataProvider provideTestItemData
    */
   public function testConjuredUpdater(array $testItemData): void
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

    $updater = new ConjuredUpdater();
    
    $this->assertTrue($updater->supports($actualItem));

    $updater->update($actualItem);

    $this->assertEquals($expectedItem, $actualItem, 'Actual and expected items do not match after passing through ConjuredUpdater!');

   }

   public function provideTestItemData(): array 
   {
        return [
            [
                'Quality decreases by 2' => [
                    'Name' => 'Conjured apple pie',        
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 5, 'expected' => 3]
                ]
            ],
            [
                'Quality decreases by 2' => [
                    'Name' => 'Conjured cherry pie',
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 3, 'expected' => 1]
                ]
            ],
            [
                'Quality decreases by 2' => [
                    'Name' => 'Conjured date pie',
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 2, 'expected' => 0]
                ]
            ],
            [
                'Quality decreases by 2' => [
                    'Name' => 'Conjured elderberry pie',
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 3, 'expected' => 1]
                ]
            ],
            [
                'Quality decreases by 4 when SellIn is negative' => [
                    'Name' => 'Conjured fig pie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 5, 'expected' => 1]
                ]
            ]
       ];
   }
}
