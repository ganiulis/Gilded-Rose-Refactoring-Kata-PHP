<?php

namespace App\Tests\Serializer;

use App\Entity\Item;
use App\Serializer\Normalizer\ItemNormalizer;
use App\Serializer\Normalizer\ItemsNormalizer;
use PHPUnit\Framework\TestCase;

class ItemsNormalizerTest extends TestCase
{
    public function testDenormalizeAll()
    {
        $mockItemNormalizer = $this->createMock(ItemNormalizer::class);

        $data = [
            ['foo'],
            ['bar']
        ];

        $mockItemNormalizer->expects($this->exactly(2))
            ->method('denormalize')
            ->withConsecutive(
                [$this->equalTo(['foo'])],
                [$this->equalTo(['bar'])]
            )
            ->willReturn(new Item())
        ;

        $itemsNormalizer = new ItemsNormalizer($mockItemNormalizer);

        $items = $itemsNormalizer->denormalizeAll($data);

        $this->assertIsArray($items, 'denormalizer did not return an array!');
    }
}
