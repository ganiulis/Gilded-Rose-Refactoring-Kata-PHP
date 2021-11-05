<?php

Namespace GildedRose\Repository;

use GildedRose\DataProcessing\DataDecoder;
use GildedRose\DataProcessing\ItemArrayNormalizer;
use GildedRose\DataProcessing\ItemNormalizer;

class ItemRepository
{
    public function __construct()
    {
        $this->arrayNormalizer = new ItemArrayNormalizer(new ItemNormalizer, new DataDecoder);
    }

    public function getFixtureItems(): array
    {
        return $this->arrayNormalizer->denormalizeItems('testfixture.csv', 'csv');
    }
}
