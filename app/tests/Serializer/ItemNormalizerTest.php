<?php

declare(strict_types=1);

namespace Tests\GildedRose\Serializer;

use GildedRose\Item;
use GildedRose\Serializer\ItemNormalizer;

use PHPUnit\Framework\TestCase;

class ItemNormalizerTest extends TestCase
{
    public function testItemNormalizer(): void
    {
        $expectedEqualItem = new Item('foo', 4, 2);

        $normalizer = new ItemNormalizer();

        $actualItem = $normalizer->denormalize(['name' => 'foo', 'sellIn' => 4, 'quality' => 2]);
    
        $this->assertIsObject($actualItem, 'ItemNormalizer class does not return object type!');
        
        $this->assertInstanceOf(Item::class, $actualItem, 'ItemNormalizer class does not return Item class!');
        
        $this->assertSame($expectedEqualItem->name, $actualItem->name, 'ItemNormalizer Item class name does not match expected Item class name!');
        $this->assertSame($expectedEqualItem->sell_in, $actualItem->sell_in, 'ItemNormalizer Item class sell_in does not match expected Item class sell_in!');
        $this->assertSame($expectedEqualItem->quality, $actualItem->quality, 'ItemNormalizer Item class quality does not match expected Item class quality!');
    }
}
