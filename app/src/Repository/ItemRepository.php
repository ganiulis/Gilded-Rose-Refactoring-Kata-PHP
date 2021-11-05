<?php

Namespace GildedRose\Repository;

use GildedRose\DataProcessing\ArrayNormalizer;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemRepository
{
    public function __construct(
        CsvEncoder $encoder,
        ArrayNormalizer $arrayNormalizer,
        string $datafileDir
    ) {
        $this->encoder = $encoder;
        $this->arrayNormalizer = $arrayNormalizer;
        $this->datafileDir = $datafileDir;
    }

    public function getItemsArray(): array
    {   
        $decodedItemsData = $this->encoder->decode(file_get_contents($this->datafileDir), 'csv');
        return $this->arrayNormalizer->denormalizeItems($decodedItemsData);
    }
}
