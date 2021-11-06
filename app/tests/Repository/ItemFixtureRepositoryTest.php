<?php

namespace Tests\Repository;

use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\Item;
use GildedRose\Repository\ItemRepository;

use PHPUnit\Framework\TestCase;

use SplFileInfo;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemFixtureRepositoryTest extends TestCase
{
    public function testItemFixtureRepository()
    {
        $actualFileInfo = new SplFileInfo(__DIR__ . '/../../data/testfixture.csv');
        $actualFilePath = $actualFileInfo->getRealPath();

        $itemRepository = new ItemRepository(
            new CsvEncoder,
            new ItemsNormalizer(new ItemNormalizer),
            $actualFilePath
        );

        $actualFixture = $itemRepository->getItems();
        
        $this->assertEquals(9, count($actualFixture), 'Fixture array count mismatch!');
        $this->assertIsArray($actualFixture, 'Fixture array is not array type!');

        foreach ($actualFixture as $item) {
            $this->assertIsObject($item, 'Entity in array is not object type!');
            $this->assertInstanceOf(Item::class, $item, 'Entity class type is not Item class!');
        }
    }
}
