<?php

Namespace GildedRose\DataProcessing;

/**
 * Currently only obligates to include denormalization for arrays.
 */
interface NormalizerInterface
{
    public function denormalize(array $array);
}
