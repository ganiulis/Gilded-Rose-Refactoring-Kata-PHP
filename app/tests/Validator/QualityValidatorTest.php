<?php

namespace Tests\Validator;

use GildedRose\Item;
use GildedRose\Validator\QualityValidator;
use PHPUnit\Framework\TestCase;

class QualityValidatorTest extends TestCase
{
    /**
     * @dataProvider provideTestItemData
    */
    public function testQualityValidator(array $testItemData)
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
        
        $validator = new QualityValidator();

        $validator->validate($actualItem);

        $this->assertEquals($expectedItem, $actualItem, 'Actual and expected items do not match after passing through QualityValidator!');
    }

    public function provideTestItemData(): array 
    {
        return [
            [
                'Good item' => [
                    'Name' => 'Apple pie',        
                    'SellIn' => ['actual' => 1, 'expected' => 1],
                    'Quality' => ['actual' => 20, 'expected' => 20]
                ]
            ],
            [
                'Too high quality item' => [
                    'Name' => 'Banana pie', 
                    'SellIn' => ['actual' => 2, 'expected' => 2],
                    'Quality' => ['actual' => 57, 'expected' => 50]
                ]
            ],
            [
                'Negative quality test' => [
                    'Name' => 'Cherry pie',
                    'SellIn' => ['actual' => 3, 'expected' => 3],
                    'Quality' => ['actual' => -12, 'expected' => 0]
                ]
            ],
            [
                'Sulfuras good item' => [
                    'Name' => 'Sulfuras, Hand of Ragnaros',
                    'SellIn' => ['actual' => 0, 'expected' => 0],
                    'Quality' => ['actual' => 80, 'expected' => 80]
                ]
            ],
            [
                'Sulfuras bad item' => [
                    'Name' => 'Sulfuras, Hand of Ragnaros',
                    'SellIn' => ['actual' => 0, 'expected' => 0],
                    'Quality' => ['actual' => -62, 'expected' => 80]
                ]
            ]
        ];
    }
}