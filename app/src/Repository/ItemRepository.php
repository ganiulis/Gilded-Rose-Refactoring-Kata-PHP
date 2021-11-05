<?php

Namespace GildedRose\Repository;

use GildedRose\DataProcessing\ArrayNormalizer;

use SplFileInfo;

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

    private function getDataFilePath(): string
    {
        $pathInfo = new SplFileInfo($this->datafileDir);
        return $pathInfo->getRealPath();
    }

    public function getItemsArray(): array
    {   
        $dataContent = file_get_contents($this->getDataFilePath());
        $decodedItemsData = $this->encoder->decode($dataContent, 'csv');
        return $this->arrayNormalizer->denormalizeItems($decodedItemsData);
    }
}
