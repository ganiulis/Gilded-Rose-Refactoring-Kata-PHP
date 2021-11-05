<?php

Namespace GildedRose\Repository;

use GildedRose\DataProcessing\DataDecoder;
use GildedRose\DataProcessing\ItemArrayNormalizer;
use GildedRose\DataProcessing\ItemNormalizer;

class ItemRepository
{
    public function getFixtureItems(): array
    {
        $data = new ItemArrayNormalizer(new ItemNormalizer, new DataDecoder);

        return $data->denormalizeItems('testfixture.csv', 'csv');
    }
}
