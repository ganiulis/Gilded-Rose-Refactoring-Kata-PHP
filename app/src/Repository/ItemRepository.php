<?php

Namespace GildedRose\Repository;

use GildedRose\DataProcessing\ItemsNormalizer;

use SplFileInfo;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemRepository
{
    public function __construct(
        CsvEncoder $encoder,
        ItemsNormalizer $itemsNormalizer,
        string $datafileDir
    ) {
        $this->encoder = $encoder;
        $this->itemsNormalizer = $itemsNormalizer;
        $this->datafileDir = $datafileDir;
    }

    private function getRealDataPath($path): string
    {
        $info = new SplFileInfo($path);
        return $info->getRealPath();
    }

    public function getItems(): array
    {   
        $filepath = $this->getRealDataPath($this->datafileDir);
        $content = file_get_contents($filepath);
        $decodedItems = $this->encoder->decode($content, 'csv');
        return $this->itemsNormalizer->denormalizeItems($decodedItems);
    }
}
