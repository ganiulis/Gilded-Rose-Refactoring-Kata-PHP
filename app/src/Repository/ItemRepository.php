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
        $filepath = $this->getRealDataPath($this->datafileDir);
        $content = file_get_contents($filepath);
        $decodedItems = $this->encoder->decode($content, 'csv');
        return $this->arrayNormalizer->denormalizeItems($decodedItems);
    }
}
