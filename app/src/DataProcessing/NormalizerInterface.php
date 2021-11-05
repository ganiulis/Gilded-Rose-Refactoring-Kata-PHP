<?php

Namespace GildedRose\DataProcessing;

/**
 * Currently only obligates to include denormalization for Item entity data.
 */
interface NormalizerInterface
{
    public function denormalize(array $decodedData);
}
