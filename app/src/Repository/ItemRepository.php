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

    private function getRealDataPath($path): string
    {
        $info = new SplFileInfo($path);
        return $info->getRealPath();
    }

    public function getItemsArray(): array
    {   
        $content = file_get_contents($this->getRealDataPath($this->datafileDir));
        $decodedItems = $this->encoder->decode($content, 'csv');
        return $this->arrayNormalizer->denormalizeItems($decodedItems);
    }
}
