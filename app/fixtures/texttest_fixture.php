<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\GildedRose;
use GildedRose\Repository\ItemRepository;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

$actualFileInfo = new SplFileInfo(__DIR__ . '/../data/testfixture.csv');
$actualFilePath = $actualFileInfo->getRealPath();

$itemRepository = new ItemRepository(
    new CsvEncoder,
    new ItemsNormalizer(new ItemNormalizer),
    $actualFilePath,
    'csv'
);

$items = $itemRepository->getItems();

$itemsUpdater = new GildedRose($items);

$days = 2;
if (count($argv) > 1) {
    $days = (int) $argv[1];
}

echo 'OMGHAI!' . PHP_EOL;

for ($i = 0; $i < $days; $i++) {
    echo "-------- day ${i} --------" . PHP_EOL;
    echo 'name, sellIn, quality' . PHP_EOL;
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $itemsUpdater->updateQuality();
}
