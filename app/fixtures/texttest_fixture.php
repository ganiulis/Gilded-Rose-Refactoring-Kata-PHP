<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\DataDecoder;

$decoder = new DataDecoder();

$decodedFixtureData = $decoder->retrieveData('testfixture.csv', 'csv');

foreach ($decodedFixtureData as $dataItem) {
    $items[] = new Item(
        $dataItem['name'],
        intval($dataItem['sellIn']),
        intval($dataItem['quality'])
    );
}

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
