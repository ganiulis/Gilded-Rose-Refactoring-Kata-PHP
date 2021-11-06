<?php

Namespace GildedRose\DataProcessing;

use GildedRose\DataProcessing\NormalizerInterface;

/**
 * Currently only denormalizes Item data into an array of Item entities
 */
class ItemsNormalizer implements NormalizerInterface
{
    public function __construct(NormalizerInterface $normalizer)
    {
        $this->Normalizer = $normalizer;
    }

    public function denormalize(array $itemsArray): array
    {
        $items = [];
        foreach ($itemsArray as $item) {
            $items[] = $this->Normalizer->denormalize($item);
        }
        return $items;
    }
}
