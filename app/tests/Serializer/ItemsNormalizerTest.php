<?php

declare(strict_types=1);

namespace Tests\Serializer;

use GildedRose\Item;
use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;

use PHPUnit\Framework\TestCase;

class ItemsNormalizerTest extends TestCase
{
    public function testItemsNormalizer(): void
    {
        $normalizedItems = [
            ['name' => 'foo', 'sellIn' => 4, 'quality' => 3],
            ['name' => 'bar', 'sellIn' => 5, 'quality' => 2],
            ['name' => 'zim', 'sellIn' => 6, 'quality' => 1],
            ['name' => 'gir', 'sellIn' => 7, 'quality' => 0]
        ];

        $expectedItems = [
            new Item('foo', 4, 3),
            new Item('bar', 5, 2),
            new Item('zim', 6, 1),
            new Item('gir', 7, 0)
        ];

        $normalizer = new ItemsNormalizer(new ItemNormalizer);

        $denormalizedItems = $normalizer->denormalizeItems($normalizedItems);
    
        $this->assertIsArray($denormalizedItems, 'ItemsNormalizer class does not return an array!');
        
        for ($i = 0; $i < count($denormalizedItems); $i++) {
            $this->assertIsObject($denormalizedItems[$i], 'Denormalized Item is not object type!');
            
            $this->assertInstanceOf(Item::class, $denormalizedItems[$i], 'Denormalized Item is not Item class!');
            
            $this->assertSame($expectedItems[$i]->name, $denormalizedItems[$i]->name, 'Denormalized Item name does not match expected Item name!');
            $this->assertSame($expectedItems[$i]->sell_in, $denormalizedItems[$i]->sell_in, 'Denormalized Item sell_in does not match expected Item sell_in!');
            $this->assertSame($expectedItems[$i]->quality, $denormalizedItems[$i]->quality, 'Denormalized Item quality does not match expected Item quality!');
        }
    }
}
