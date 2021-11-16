<?php

namespace Tests\Validator;

use GildedRose\Item;
use GildedRose\Validator\SulfurasValidator;
use PHPUnit\Framework\TestCase;

class SulfurasValidatorTest extends TestCase
{
    /**
     * @dataProvider provideTestItemData
    */
    public function testSulfurasValidator(array $testItemData)
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
        
        $validator = new SulfurasValidator();

        $this->assertEquals($testItemData['Supported'], $validator->supports($actualItem), 'Item is unsupported!');

        if ($validator->supports($actualItem)) {
            $validator->validate($actualItem);
            $this->assertEquals($expectedItem, $actualItem, 'Actual and expected items do not match after passing through QualityValidator!');
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