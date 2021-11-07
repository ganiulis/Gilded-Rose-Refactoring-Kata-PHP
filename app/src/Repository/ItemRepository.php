<?php

namespace GildedRose\Repository;

use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\Data\ContentRetrieverInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

/**
 * Instantiates a repository class for Item object.
 * 
 * Currently only getItems method exists.
 */
class ItemRepository
{
    /**
     * @param ContentRetrieverInterface $contentRetriever data retriever class
     * @param DecoderInterface $encoder encoder class taken from Symfony
     * @param ItemsNormalizer $itemsNormalizer normalizer class
     * @param string $contentDir data content
     * @param string $contentType encoded content type
     */
    public function __construct(
        ContentRetrieverInterface $contentRetriever,
        DecoderInterface $encoder,
        ItemsNormalizer $itemsNormalizer,
        string $contentDir,
        string $contentType
    ) {
        $this->contentRetriever = $contentRetriever;
        $this->encoder = $encoder;
        $this->itemsNormalizer = $itemsNormalizer;
        $this->contentDir = $contentDir;
        $this->contentType = $contentType;
    }

    /**
     * Returns all items from a specific csv file.
     * 
     * @return array an array of Item objects
     */
    public function getItems(): array
    {   
        $retrievedItems = $this->contentRetriever->retrieveContent($this->contentDir);
        $decodedItems = $this->encoder->decode($retrievedItems, $this->contentType);
        return $this->itemsNormalizer->denormalizeItems($decodedItems);
    }
}
