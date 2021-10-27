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
    public function testItem($expectedResult, $input): void
    {
        $gildedRose = new GildedRose([$input]);
        
        $gildedRose->updateQuality();

        $this->assertEquals($expectedResult, $input);
    }

    public function provideItemData()
    {
        return [
            [
                new Item('Mana Cake', 5, 6),
                new Item('Mana Cake', 6, 7)
            ],
            [
                new Item('Water, nonConjured', 1, 4),
                new Item('Water, nonConjured', 2, 5),
            ],
            [
                new Item('Just Cake', 6, 0),
                new Item('Just Cake', 7, 0)
            ],
            [
                new Item('Water', 4, 1),
                new Item('Water', 5, 2)
            ],
            [
                new Item('Big preconjured Mana Cake', 0, 5),
                new Item('Big preconjured Mana Cake', 1, 6)
            ]
        ];
    }
}
