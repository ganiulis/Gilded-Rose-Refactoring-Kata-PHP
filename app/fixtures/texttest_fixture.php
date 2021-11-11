<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\Data\FileContentRetriever;
use GildedRose\Repository\ItemRepository;
use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\StockManager;
use GildedRose\Updater\StockProcessor;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

$itemRepository = new ItemRepository(
    new FileContentRetriever,
    new CsvEncoder, 
    new ItemsNormalizer(new ItemNormalizer)
);

$filepath = __DIR__ . '/../data/testfixture.csv';

$itemRepository->setItems($filepath, 'csv');
$items = $itemRepository->getItems();

$stockProcessor = new StockManager(new StockProcessor());

$days = 2;
if (count($argv) > 1) {
    $days = (int) $argv[1];
}

$stockProcessor->process($items, intval($days));
