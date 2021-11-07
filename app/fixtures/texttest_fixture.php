<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\Data\FileContentRetriever;
use GildedRose\ItemsProcessor;
use GildedRose\Repository\ItemRepository;
use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

$filepath = __DIR__ . '/../data/testfixture.csv';

$itemRepository = new ItemRepository(
    new FileContentRetriever,
    new CsvEncoder, 
    new ItemsNormalizer(new ItemNormalizer),
    $filepath,
    'csv'
);

$items = $itemRepository->getItems();

$itemsProcessor = new ItemsProcessor($items);

$days = 2;
if (count($argv) > 1) {
    $days = (int) $argv[1];
}

$itemsProcessor->processItems(intval($days));
