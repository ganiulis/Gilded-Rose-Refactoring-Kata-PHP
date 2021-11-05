<?php

Namespace GildedRose\DataProcessing;

use GildedRose\DataProcessing\NormalizerInterface;

/**
 * Currently only denormalizes Item data into an array of Item entities
 */
class ArrayNormalizer
{
    public function __construct(NormalizerInterface $normalizer)
    {
        $this->Normalizer = $normalizer;
    }

    public function denormalizeItems(array $arrayItems): array
    {
        $items = [];
        foreach ($arrayItems as $item) {
            $items[] = $this->Normalizer->denormalizeItem($item);
        }
        return $items;
    }
}
