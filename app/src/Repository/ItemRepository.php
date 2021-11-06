<?php

namespace GildedRose\Repository;

use GildedRose\Serializer\ItemsNormalizer;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemRepository
{
    public function __construct(
        CsvEncoder $encoder,
        ItemsNormalizer $itemsNormalizer,
        string $filepath
    ) {
        $this->encoder = $encoder;
        $this->itemsNormalizer = $itemsNormalizer;
        $this->filepath = $filepath;
    }

    public function getItems(): array
    {   
        $content = file_get_contents($this->filepath);
        $decodedItems = $this->encoder->decode($content, 'csv');

        return $this->itemsNormalizer->denormalizeItems($decodedItems);
    }
}
