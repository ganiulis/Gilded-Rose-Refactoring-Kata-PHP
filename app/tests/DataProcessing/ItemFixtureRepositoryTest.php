<?php

use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\Item;
use GildedRose\Repository\ItemRepository;

use PHPUnit\Framework\TestCase;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemFixtureRepositoryTest extends TestCase
{
    public function testItemFixtureRepository()
    {
        $itemRepository = new ItemRepository(new CsvEncoder, new ItemsNormalizer(new ItemNormalizer), '/app/data/testfixture.csv');

        $actualFixture = $itemRepository->getItems();
        
        $this->assertEquals(9, count($actualFixture), 'Fixture array count mismatch!');
        $this->assertIsArray($actualFixture, 'Fixture array is not array type!');

        foreach ($actualFixture as $item) {
            $this->assertIsObject($item, 'Entity in array is not object type!');
            $this->assertInstanceOf(Item::class, $item, 'Entity class type is not Item class!');
        }
    }
}
