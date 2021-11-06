<?php

Namespace GildedRose\Serializer;

/**
 * Currently only obligates to include denormalization for arrays.
 */
interface NormalizerInterface
{
    public function denormalize(array $array): object;
}
