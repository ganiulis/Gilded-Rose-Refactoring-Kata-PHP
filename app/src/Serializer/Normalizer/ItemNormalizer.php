<?php

namespace App\Serializer\Normalizer;

use App\Serializer\Normalizer\NormalizerInterface;
use App\Entity\Item;

/**
 * Takes data for an Item and outputs an Item entity.
 */
class ItemNormalizer implements NormalizerInterface
{
    public function denormalize(array $itemData): Item
    {
        $itemObject = new Item();

        $itemObject->setName($itemData['name']);
        $itemObject->setSellIn($itemData['sellIn']);
        $itemObject->setQuality($itemData['quality']);

        return $itemObject;
    }
}
