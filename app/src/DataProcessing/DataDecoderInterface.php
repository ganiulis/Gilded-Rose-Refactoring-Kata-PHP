<?php

Namespace GildedRose\DataProcessing;

/**
 * Currently only obligates to decode data from file.
 */
interface DataDecoderInterface
{
    public function decodeFile(string $dataFile, string $dataType): array;
}
