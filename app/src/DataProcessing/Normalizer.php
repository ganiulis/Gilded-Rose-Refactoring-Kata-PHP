<?php

Namespace GildedRose\DataProcessing;

use GildedRose\Item;
use GildedRose\DataProcessing\NormalizerInterface;

/**
 * Takes a decoded data item and returns an Item object
 */
class Normalizer implements NormalizerInterface
{
    public function denormalizeItem(array $decodedData): Item
    {
        return new Item($decodedData['name'], intval($decodedData['sellIn']), intval($decodedData['quality']));
    }
}
