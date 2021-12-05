<?php

namespace App\Tests\Serializer;

use App\Serializer\Normalizer\ItemNormalizer;
use PHPUnit\Framework\TestCase;

class ItemNormalizerTest extends TestCase
{
    public function testDenormalize(): object
    {
        $itemData = [
            'name' => 'Aged Brie',
            'sellIn' => 4,
            'quality' => 2
        ];

        $normalizer = new ItemNormalizer();

        $item = $normalizer->denormalize($itemData);
        
        $this->assertIsObject($item, 'denormalizer did not return an object!');

        return $item;
    }

    /**
     * @depends testDenormalize
     */
    public function testInstanceOf(object $item): void
    {
        $this->assertInstanceOf('App\Entity\Item', $item, 'denormalized object is not an instance of App\Entity\Item!');
    }
}
