<?php

namespace App\Serializer\Normalizer;

use App\Serializer\Normalizer\NormalizerInterface;

/**
 * Denormalizes an array of Item data into an array of Item entities.
 */
class ItemsNormalizer
{
    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function denormalizeAll(array $itemsData): array
    {
        $itemObjects = [];

        foreach ($itemsData as $itemData) {
            $itemObjects[] = $this->normalizer->denormalize($itemData);
        }

        return $itemObjects;
    }
}
