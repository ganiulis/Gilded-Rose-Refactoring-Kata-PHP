<?php

namespace App\Serializer;

use App\Serializer\Normalizer\ItemsNormalizer;
use App\Serializer\Retriever\RetrieverInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

/**
 * Serializer class which retrieves, decodes and denormalizes Item data into an array of Item entities.
 */
class ItemSerializer implements SerializerInterface
{
    public function __construct(
        RetrieverInterface $retriever,
        DecoderInterface $encoder,
        ItemsNormalizer $normalizer
    ) {
        $this->retriever = $retriever;
        $this->encoder = $encoder;
        $this->normalizer = $normalizer;
    }

    /**
     * Retrieves, decodes and denormalizes Item data into an array of Item entities.
     *
     * @param string $directory directory of the datafile
     * @param string $type format of the datafile
     * @return array
     */
    public function deserialize(string $directory, string $type): array
    {   
        $retrievedData = $this->retriever->retrieve($directory);

        $decodedData = $this->encoder->decode($retrievedData, $type);

        $items = $this->normalizer->denormalizeAll($decodedData);

        return $items;
    }
}
