<?php

namespace Tests\Repository;

use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\Item;
use GildedRose\Repository\ItemRepository;

use PHPUnit\Framework\TestCase;

use SplFileInfo;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemRepositoryTest extends TestCase
{
    public function testItemRepository(): void
    {
        $denormalizedItems = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('Aged Brie', 2, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item("Sulfuras, Hand of Ragnaros", 0, 80),
            new Item("Sulfuras, Hand of Ragnaros", -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
            new Item('Conjured Mana Cake', 3, 6)
        ];

        $mockRepository = $this->getMockBuilder(ItemRepository::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
        
        $mockRepository->method('getItems')
            ->willReturn($denormalizedItems);

        $this->assertSame($denormalizedItems, $mockRepository->getItems());
    }
}
