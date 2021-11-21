<?php

namespace Tests\Updater\Checker;

use GildedRose\Item;
use GildedRose\Updater\Checker\SulfurasChecker;
use PHPUnit\Framework\TestCase;

class SulfurasCheckerTest extends TestCase
{
    /**
     * @dataProvider provideTestItemData
    */
    public function testSulfurasChecker(array $testItemData): void
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
        
        $checker = new SulfurasChecker();

        $this->assertEquals($testItemData['Supported'], $checker->supports($actualItem), 'Item is unsupported!');

        if ($checker->supports($actualItem)) {
            $checker->checkQuality($actualItem);
            $this->assertEquals($expectedItem, $actualItem, 'Actual and expected items do not match after passing through Qualitychecker!');
        }
    }

    public function provideTestItemData(): array 
    {
        return [
            [
                'Good Sulfuras item' => [
                    'Name' => 'Sulfuras, Hand of Ragnaros',        
                    'SellIn' => ['actual' => 1, 'expected' => 1],
                    'Quality' => ['actual' => 80, 'expected' => 80],
                    'Supported' => true
                ]
            ],
            [
                'Too high quality Sulfuras item' => [
                    'Name' => 'Sulfuras, Hand of Ragnaros', 
                    'SellIn' => ['actual' => 2, 'expected' => 2],
                    'Quality' => ['actual' => 57, 'expected' => 80],
                    'Supported' => true
                ]
            ],
            [
                'Negative quality Sulfuras test' => [
                    'Name' => 'Sulfuras, Hand of Ragnaros',
                    'SellIn' => ['actual' => 3, 'expected' => 3],
                    'Quality' => ['actual' => -12, 'expected' => 80],
                    'Supported' => true
                ]
            ],
            [
                'Unsupported item' => [
                    'Name' => 'Sulfootras, Foot of Ragnaros',
                    'SellIn' => ['actual' => 3, 'expected' => 3],
                    'Quality' => ['actual' => 45, 'expected' => 45],
                    'Supported' => false
                ]
            ]
        ];
    }
}