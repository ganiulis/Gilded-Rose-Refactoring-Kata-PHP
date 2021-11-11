<?php 

namespace GildedRose\Updater;

use GildedRose\Item;

interface UpdaterInterface
{
    public function supportsItem(Item $item): bool;
    public function updateItem(Item $item): Item;
}
