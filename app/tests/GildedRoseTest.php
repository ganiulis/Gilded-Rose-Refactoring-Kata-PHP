<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /**
     * @dataProvider provideItemData
     */
    public function testItem($name, $sellIn, $quality): void
    {
        $itemTest = new Item($name, $sellIn['SellIn test'], $quality['Quality test']);
        $itemResult = new Item($name, $sellIn['SellIn result'], $quality['Quality result']);

        $gildedRose = new GildedRose([$itemTest]);
        
        $gildedRose->updateQuality();

        $this->assertEquals($itemResult, $itemTest);
    }

    public function provideItemData()
    {
        return [
            [
                'Mana Cake',
                [
                    'SellIn test' => 6, 
                    'SellIn result' => 5
                ],
                [
                    'Quality test' => 2, 
                    'Quality result' => 1
                ]
            ],
            [
                'Conjured Cake',
                [
                    'SellIn test' => 6, 
                    'SellIn result' => 5
                ],
                [
                    'Quality test' => 2, 
                    'Quality result' => 0
                ]
            ],
            [
                'nonConjured Cake',
                [
                    'SellIn test' => 6, 
                    'SellIn result' => 5
                ],
                [
                    'Quality test' => 2, 
                    'Quality result' => 1
                ]
            ],
            [
                'Water',
                [
                    'SellIn test' => 0, 
                    'SellIn result' => -1
                ],
                [
                    'Quality test' => 2, 
                    'Quality result' => 0
                ]
            ]
        ];
    }
}
