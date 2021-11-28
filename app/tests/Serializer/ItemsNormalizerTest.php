<?php

declare(strict_types=1);

namespace Tests\GildedRose\Serializer;

use GildedRose\Item;
use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;

use PHPUnit\Framework\TestCase;

class ItemsNormalizerTest extends TestCase
{
    public function testItemsNormalizer(): void
    {
        $mockItemNormalizer = $this->createMock(ItemNormalizer::class);
            
        $mockItemNormalizer
            ->expects($this->exactly(4))
            ->method('denormalize')
            ->withConsecutive(
                [['foo', 4, 3]],
                [['bar', 5, 2]],
                [['zim', 6, 1]],
                [['gir', 7, 0]]
            )
            ->willReturnOnConsecutiveCalls(
                new Item('foo', 4, 3),
                new Item('bar', 5, 2),
                new Item('zim', 6, 1),
                new Item('gir', 7, 0)
            );

        $itemsNormalizer = new ItemsNormalizer($mockItemNormalizer);

        $input = [
            ['foo', 4, 3],
            ['bar', 5, 2],
            ['zim', 6, 1],
            ['gir', 7, 0]
        ];

        $actualItems = $itemsNormalizer->denormalizeItems($input);

        $expectedItems = [
            new Item('foo', 4, 3),
            new Item('bar', 5, 2),
            new Item('zim', 6, 1),
            new Item('gir', 7, 0)
        ];
    
        $this->assertIsArray($actualItems, 'ItemsNormalizer class does not return an array!');
        $this->assertEquals($expectedItems, $actualItems, 'ItemsNormalizer class does not return the expected array of Item entities!');
    }
}
