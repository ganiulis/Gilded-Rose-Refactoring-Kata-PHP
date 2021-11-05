<?php

Namespace GildedRose\Repository;

use GildedRose\DataProcessing\ArrayNormalizer;
use SplFileInfo;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemRepository
{
    public function __construct(
        CsvEncoder $encoder,
        ArrayNormalizer $arrayNormalizer
    ) {
        $this->encoder = $encoder;
        $this->arrayNormalizer = $arrayNormalizer;
    }

    public function getItemsArray(string $datafilePath): array
    {   
        $dir = new SplFileInfo($datafilePath);
        $decodedItemsData = $this->encoder->decode(file_get_contents($dir), 'csv');
        return $this->arrayNormalizer->denormalizeItems($decodedItemsData);
    }
}
