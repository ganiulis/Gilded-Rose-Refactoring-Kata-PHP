<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\Data\FileContentRetriever;
use GildedRose\Repository\ItemRepository;
use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\StockManager;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

$itemRepository = new ItemRepository(
    new FileContentRetriever,
    new CsvEncoder, 
    new ItemsNormalizer(new ItemNormalizer)
);

$filepath = __DIR__ . '/../data/testfixture.csv';

$itemRepository->setItems($filepath, 'csv');
$items = $itemRepository->getItems();

$stockManager = new StockManager();

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
    $stockManager->updateAll($items);
}
