<?php

namespace Tests\Validator;

use GildedRose\Item;
use GildedRose\Validator\DefaultValidator;
use PHPUnit\Framework\TestCase;

class DefaultValidatorTest extends TestCase
{
    /**
     * @dataProvider provideTestItemData
    */
    public function testDefaultValidator(array $testItemData)
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
        
        $validator = new DefaultValidator();

        $this->assertEquals($testItemData['Supported'], $validator->supports($actualItem), 'Item is unsupported!');

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
                    'Quality' => ['actual' => 20, 'expected' => 20],
                    'Supported' => true
                ]
            ],
            [
                'Too high quality item' => [
                    'Name' => 'Banana pie', 
                    'SellIn' => ['actual' => 2, 'expected' => 2],
                    'Quality' => ['actual' => 57, 'expected' => 50],
                    'Supported' => true
                ]
            ],
            [
                'Negative quality test' => [
                    'Name' => 'Cherry pie',
                    'SellIn' => ['actual' => 3, 'expected' => 3],
                    'Quality' => ['actual' => -12, 'expected' => 0],
                    'Supported' => true
                ]
            ]
        ];
    }
}