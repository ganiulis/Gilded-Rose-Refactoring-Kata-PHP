<?php 

namespace GildedRose\Updater\Checker;

use GildedRose\Item;

interface CheckerInterface
{
    public function supports(Item $item): bool;
    public function checkQuality(Item $item): Item;
}
