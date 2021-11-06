<?php

namespace GildedRose\Repository;

use GildedRose\Serializer\ItemsNormalizer;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

/**
 * Instantiates a repository class for Item object.
 * 
 * Currently only getItems method exists.
 */
class ItemRepository
{
    /**
     * @param CsvEncoder $encoder currently only csv data is allowed
     * @param ItemsNormalizer $itemsNormalizer normalizer class
     * @param string $filepath needs an absolute filepath
     */
    public function __construct(
        CsvEncoder $encoder,
        ItemsNormalizer $itemsNormalizer,
        string $filepath
    ) {
        $this->encoder = $encoder;
        $this->itemsNormalizer = $itemsNormalizer;
        $this->filepath = $filepath;
    }

    /**
     * Returns all items from a specific csv file.
     * 
     * @return array an array of Item objects
     */
    public function getItems(): array
    {   
        $content = file_get_contents($this->filepath);
        $decodedItems = $this->encoder->decode($content, 'csv');

        return $this->itemsNormalizer->denormalizeItems($decodedItems);
    }
}
