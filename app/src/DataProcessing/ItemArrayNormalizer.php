<?php

Namespace GildedRose\DataProcessing;

use GildedRose\DataProcessing\DataDecoderInterface;
use GildedRose\DataProcessing\ItemNormalizerInterface;

/**
 * Takes a decoded data array and returns an array of Item objects
 */
class ItemArrayNormalizer
{
    public function __construct(
        ItemNormalizerInterface $itemNormalizer,
        DataDecoderInterface $dataDecoder
    ) {
        $this->itemNormalizer = $itemNormalizer;
        $this->dataDecoder = $dataDecoder;
    }

    public function denormalizeItems(string $itemsFile, string $itemsFormat): array
    {
        $decodedItems = $this->dataDecoder->decodeFile($itemsFile, $itemsFormat);

        foreach ($decodedItems as $item) {
            $items[] = $this->itemNormalizer->denormalizeItem($item);
        }
        return $items;
    }
}
