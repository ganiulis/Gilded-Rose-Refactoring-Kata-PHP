<?php

namespace App\Tests\Serializer;

use App\Entity\Item;
use App\Serializer\ItemSerializer;
use App\Serializer\Normalizer\ItemsNormalizer;
use App\Serializer\Retriever\FileContentRetriever;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemSerializerTest extends TestCase
{
    public function testDeserialize(): void
    {
        $mockRetriever = $this->createMock(FileContentRetriever::class);
        $mockRetriever->expects($this->once())
            ->method('retrieve')
            ->with(__DIR__.'/fake_path_to_file.csv')
            ->willReturn('raw, content, from, file, in, csv, format');

        $mockEncoder = $this->createMock(CsvEncoder::class);
        $mockEncoder->expects($this->once())
            ->method('decode')
            ->with('raw, content, from, file, in, csv, format', 'csv')
            ->willReturn(['decoded', 'content', 'from', 'file', 'in', 'array', 'type']);

        $mockNormalizer = $this->createMock(ItemsNormalizer::class);
        $mockNormalizer->expects($this->once())
            ->method('denormalizeAll')
            ->with(['decoded', 'content', 'from', 'file', 'in', 'array', 'type'])
            ->willReturn([Item::class, Item::class, Item::class, Item::class, Item::class, Item::class, Item::class]);

        $serializer = new ItemSerializer(
            $mockRetriever,
            $mockEncoder,
            $mockNormalizer
        );

        $items = $serializer->deserialize(__DIR__.'/fake_path_to_file.csv', 'csv');

        $this->assertIsArray($items, 'deserializer did not return an array!');
    }
}
