<?php

declare(strict_types=1);

namespace Tests\Updater;

use GildedRose\Item;
use GildedRose\Updater\ConjuredUpdater;
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
                'First test' => [
                    'Name' => 'Conjured apple pie',        
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 5, 'expected' => 3]
                ]
            ],
            [
                'Second test' => [
                    'Name' => 'Conjured banana pie', 
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 4, 'expected' => 2]
                ]
            ],
            [
                'Third test' => [
                    'Name' => 'Conjured cherry pie',
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 3, 'expected' => 1]
                ]
            ],
            [
                'Fourth test' => [
                    'Name' => 'Conjured date pie',
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 2, 'expected' => 0]
                ]
            ],
            [
                'Fifth test' => [
                    'Name' => 'Conjured elderberry pie',
                    'SellIn' => ['actual' => 2, 'expected' => 1],
                    'Quality' => ['actual' => 1, 'expected' => 0]
                ]
            ],
            [
                'Sixth test' => [
                    'Name' => 'Conjured fig pie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 0, 'expected' => 0]
                ]
            ],
            [
                'Seventh test' => [
                    'Name' => 'Conjured guava pie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 5, 'expected' => 1]
                ]
            ],
            [
                'Eight test' => [
                    'Name' => 'Conjured honeydew pie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 4, 'expected' => 0]
                ]
            ],
            [
                'Ninth test' => [
                    'Name' => 'Conjured jackfruit pie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 3, 'expected' => 0]
                ]
            ],
            [
                'Tenth test' => [
                    'Name' => 'Conjured kiwi pie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 2, 'expected' => 0]
                ]
            ],
            [
                'Eleventh test' => [
                    'Name' => 'Conjured lemon pie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 1, 'expected' => 0]
                ]
            ],
            [
                'Twelfth test' => [
                    'Name' => 'Conjured meat pie',
                    'SellIn' => ['actual' => 0, 'expected' => -1],
                    'Quality' => ['actual' => 0, 'expected' => 0]
                ]
            ],
            [
                'Thirteenth test' => [
                    'Name' => 'Conjured nectarine pie',
                    'SellIn' => ['actual' => -1, 'expected' => -2],
                    'Quality' => ['actual' => 0, 'expected' => 0]
                ]
            ],
            [
                'Fourteenth test' => [
                    'Name' => 'Conjured olive pie',
                    'SellIn' => ['actual' => -1, 'expected' => -2],
                    'Quality' => ['actual' => 5, 'expected' => 1]
                ]
            ]
       ];
   }
}
