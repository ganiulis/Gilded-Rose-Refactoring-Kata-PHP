<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class ConjuredItemTest extends TestCase
{
    public function testConjuredItems(): void
    {
        $testItems = [
            new Item('Conjured Mana Cake', -1, 8),
            new Item('Conjured Mana Cake', 0, 7),
            new Item('Big preconjured Mana Cake', 1, 6),
            new Item('Water, Conjured', 2, 5),
            new Item('Conjured Mana Cake', 3, 4),
            new Item('Conjured Water', 4, 3),
            new Item('Conjured Water', 5, 2),
            new Item('Conjured Mana Cake', 6, 1),
            new Item('Conjured Mana Cake', 7, 0)
        ];

        $gildedRose = new GildedRose($testItems);
        $gildedRose->updateQuality();

        $sampleItems = [
            new Item('Conjured Mana Cake', -2, 4),
            new Item('Conjured Mana Cake', -1, 3),
            new Item('Big preconjured Mana Cake', 0, 5),
            new Item('Water, Conjured', 1, 3),
            new Item('Conjured Mana Cake', 2, 2),
            new Item('Conjured Water', 3, 1),
            new Item('Conjured Water', 4, 0),
            new Item('Conjured Mana Cake', 5, 0),
            new Item('Conjured Mana Cake', 6, 0)
        ];

        $this->assertEquals($sampleItems, $testItems);
    }
}
