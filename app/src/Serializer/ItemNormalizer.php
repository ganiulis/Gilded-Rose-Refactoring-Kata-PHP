<?php

namespace App\Serializer;

use App\Serializer\NormalizerInterface;
use App\Entity\Item;

/**
 * Takes a decoded data item and returns an Item object
 */
class ItemNormalizer implements NormalizerInterface
{
    public function denormalize(array $itemArray): Item
    {
        return new Item($itemArray['name'], intval($itemArray['sellIn']), intval($itemArray['quality']));
    }
}
