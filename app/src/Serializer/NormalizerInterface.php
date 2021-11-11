<?php

namespace GildedRose\Serializer;

/**
 * Currently only obligates to include denormalization for arrays.
 */
interface NormalizerInterface
{
    public function denormalize(array $data): object;
}
