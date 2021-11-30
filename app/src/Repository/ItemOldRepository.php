<?php

namespace App\Repository;

use App\Serializer\ItemsNormalizer;
use App\Data\ContentRetrieverInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

use Exception;

/**
 * Instantiates a repository class for Item object.
 * 
 * Currently only getItems method exists.
 */
class ItemOldRepository
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
        ItemsNormalizer $itemsNormalizer
    ) {
        $this->contentRetriever = $contentRetriever;
        $this->encoder = $encoder;
        $this->itemsNormalizer = $itemsNormalizer;
    }

    /**
     * Sets the directory and type of the Item data.
     *
     * @param string $contentDir full directory of the Item data
     * @param string $contentType type of Item data
     * @return void
     */
    public function setItems(string $contentDir, string $contentType): void
    {
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
        if (!isset($this->contentDir) || !isset($this->contentDir)) {
            throw new Exception('Item data has not been set! Please use ->setItems(...) first.');
        } else {
            $retrievedItems = $this->contentRetriever->retrieveContent($this->contentDir);
            $decodedItems = $this->encoder->decode($retrievedItems, $this->contentType);
            return $this->itemsNormalizer->denormalizeItems($decodedItems);
        }
    }
}
