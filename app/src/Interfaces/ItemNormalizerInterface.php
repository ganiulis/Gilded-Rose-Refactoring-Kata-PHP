<?php

Namespace GildedRose\Interfaces;

use GildedRose\Item;

/**
 * Currently only obligates to include denormalization for Item entity data.
 */
interface ItemNormalizerInterface
{
    public function denormalizeItem(array $decodedData): Item;
}
