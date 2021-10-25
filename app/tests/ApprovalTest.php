<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class ApprovalTest extends TestCase
{
    public function testTestFixture()
    {
        $list = array();

        $list[] = 'OMGHAI!' . PHP_EOL;

        $items = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('Aged Brie', 2, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
            // this conjured item does not work properly yet
            new Item('Conjured Mana Cake', 3, 6)
        ];

        $app = new GildedRose($items);

        $days = 30 + 1; // + 1 added as actual test is counted from day 0

        for ($i = 0; $i < $days; $i++) {
            $list[] = "-------- day ${i} --------" . PHP_EOL;
            $list[] = 'name, sellIn, quality' . PHP_EOL;
            foreach ($items as $item) {
                $list[] = $item . PHP_EOL;
            }
            $list[] = PHP_EOL;
            $app->updateQuality();
        }
        
        Approvals::verifyString($list);
    }
}