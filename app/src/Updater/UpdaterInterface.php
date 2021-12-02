<?php 

namespace App\Updater;

use App\Entity\Item;

interface UpdaterInterface
{
    public function supports(Item $item): bool;
    public function update(Item $item): Item;
}
