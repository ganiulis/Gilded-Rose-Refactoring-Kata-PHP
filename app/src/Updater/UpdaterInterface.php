<?php 

namespace GildedRose\Updater;

use GildedRose\Item;

interface UpdaterInterface
{
    public function supports(Item $item): bool;
    public function update(Item $item): Item;
}
