<?php

Namespace GildedRose\DataProcessing;

use GildedRose\Item;
use GildedRose\DataProcessing\NormalizerInterface;

/**
 * Takes a decoded data item and returns an Item object
 */
class ItemNormalizer implements NormalizerInterface
{
    public function denormalize(array $decodedData): Item
    {
        return new Item($decodedData['name'], intval($decodedData['sellIn']), intval($decodedData['quality']));
    }
}
