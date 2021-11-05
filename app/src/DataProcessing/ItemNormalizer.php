<?php

Namespace GildedRose\DataProcessing;

use GildedRose\Item;
use GildedRose\DataProcessing\ItemNormalizerInterface;

/**
 * Takes a decoded data item and returns an Item object
 */
class ItemNormalizer implements ItemNormalizerInterface
{
    public function denormalizeItem(array $decodedData): Item
    {
        return new Item($decodedData['name'], intval($decodedData['sellIn']), intval($decodedData['quality']));
    }
}
