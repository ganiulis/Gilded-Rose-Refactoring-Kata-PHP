<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\Data\FileContentRetriever;
use GildedRose\Printer\StockPrinter;
use GildedRose\Updater;
use GildedRose\Repository\ItemRepository;
use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\StockManager;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

$itemRepository = new ItemRepository(
    new FileContentRetriever(),
    new CsvEncoder(), 
    new ItemsNormalizer(new ItemNormalizer())
);

$filepath = __DIR__ . '/../src/DataFixtures/testfixture.csv';
$itemRepository->setItems($filepath, 'csv');
$items = $itemRepository->getItems();

$manager = new StockManager(
    new Updater\DefaultUpdater(),
    [
        new Updater\BackstageUpdater(),
        new Updater\BrieUpdater(),
        new Updater\ConjuredUpdater(),
        new Updater\SulfurasUpdater()
    ]
);

$days = 2;
if (count($argv) > 1) {
    $days = (int) $argv[1];
}

$printer = new StockPrinter();

$printer->printIntro();

for ($day = 0; $day < $days; $day++) {
    $printer->printSummary($items, $day);
    $manager->updateAll($items);
}
