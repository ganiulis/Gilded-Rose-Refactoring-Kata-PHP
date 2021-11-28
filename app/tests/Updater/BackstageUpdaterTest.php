<?php

declare(strict_types=1);

namespace App\Tests\Updater;

use App\Entity\Item;
use App\Updater\BackstageUpdater;
use PHPUnit\Framework\TestCase;

/**
 * Tests BackstageUpdater behaviour
 */
class BackstageUpdaterTest extends TestCase
{
    /**
     * @dataProvider provideTestItemData
    */
   public function testBackstageUpdater(array $testItemData): void
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

    $updater = new BackstageUpdater();
    
    $this->assertTrue($updater->supports($actualItem));

    $updater->update($actualItem);

    $this->assertEquals($expectedItem, $actualItem, 'Actual and expected items do not match after passing through BackstageUpdater!');

   }

   public function provideTestItemData(): array 
   {
       return [
            [
                'More than 11 days left - quality increases by 1' => [
                    'Name' => 'Backstage passes to a TAFKAL80ETC concert',        
                    'SellIn' => ['actual' => 12, 'expected' => 11],
                    'Quality' => ['actual' => 48, 'expected' => 49]
                ]
            ],
            [
                'More than 11 days left - quality increases by 1' => [
                    'Name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'SellIn' => ['actual' => 12, 'expected' => 11],
                    'Quality' => ['actual' => 50, 'expected' => 50]
                ]
            ],
            [
                '10 or less days left - quality increases by 2' => [
                    'Name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'SellIn' => ['actual' => 10, 'expected' => 9],
                    'Quality' => ['actual' => 47, 'expected' => 49]
                ]
            ],
            [
                '10 or less days left - quality increases by 2' => [
                    'Name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'SellIn' => ['actual' => 10, 'expected' => 9],
                    'Quality' => ['actual' => 49, 'expected' => 50]
                ]
            ],
            [
                '5 or less days left - quality increases by 3' => [
                    'Name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'SellIn' => ['actual' => 5, 'expected' => 4],
                    'Quality' => ['actual' => 46, 'expected' => 49]
                ]
            ],
            [
                '5 or less days left - quality increases by 3' => [
                    'Name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'SellIn' => ['actual' => 5, 'expected' => 4],
                    'Quality' => ['actual' => 49, 'expected' => 50]
                ]
            ],
            [
                'Item expires and quality drops to 0' => [
                    'Name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 50, 'expected' => 0]
                ]
            ],
            [
                'Item expires and quality drops to 0' => [
                    'Name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 1, 'expected' => 0]
                ]
            ],
            [
                'Item expires and quality drops to 0' => [
                    'Name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'SellIn' => ['actual' => -1, 'expected' => -2],
                    'Quality' => ['actual' => 0, 'expected' => 0]
                ]
            ]
       ];
   }
}
