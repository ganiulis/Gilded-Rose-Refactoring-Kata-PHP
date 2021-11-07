<?php

namespace GildedRose\Repository;

use GildedRose\Serializer\ItemsNormalizer;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

/**
 * Instantiates a repository class for Item object.
 * 
 * Currently only getItems method exists.
 */
class ItemRepository
{
    /**
     * @param EncoderInterface $encoder currently only csv data is allowed
     * @param ItemsNormalizer $itemsNormalizer normalizer class
     * @param string $filepath needs an absolute filepath
     */
    public function __construct(
        EncoderInterface $encoder,
        ItemsNormalizer $itemsNormalizer,
        string $filepath,
        string $filetype
    ) {
        $this->encoder = $encoder;
        $this->itemsNormalizer = $itemsNormalizer;
        $this->filepath = $filepath;
        $this->filetype = $filetype;
    }

    /**
     * Returns all items from a specific csv file.
     * 
     * @return array an array of Item objects
     */
    public function getItems(): array
    {   
        $content = file_get_contents($this->filepath);
        $decodedItems = $this->encoder->decode($content, $this->filetype);

        return $this->itemsNormalizer->denormalizeItems($decodedItems);
    }
}
