<?php

namespace GildedRose\Serializer;

use GildedRose\Serializer\NormalizerInterface;

/**
 * Currently only denormalizes Item data into an array of Item entities
 */
class ItemsNormalizer
{
    public function __construct(NormalizerInterface $normalizer)
    {
        $this->Normalizer = $normalizer;
    }

    public function denormalizeItems(array $itemsArray): array
    {
        $items = [];
        foreach ($itemsArray as $item) {
            $items[] = $this->Normalizer->denormalize($item);
        }
        return $items;
    }
}
