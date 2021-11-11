<?php 

namespace GildedRose\Updater;

use GildedRose\Item;

interface UpdaterInterface
{
    public function updateItem(Item $item): Item;
}
