<?php

namespace App\Tests\Repository;

use App\Data\FileContentRetriever;
use App\Item;
use App\Serializer\ItemsNormalizer;
use App\Repository\ItemSerializer;

use PHPUnit\Framework\TestCase;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemSerializerTest extends TestCase
{
    public function testItemSerializer(): void
    {
        $filepath = 'filepath/to/content';
        $fileContent = 'content in a string';
        $fileType = 'filetype';
        $decodedContent = ['this', 'is', 'an', 'array'];
        $expectedContent = [
            new Item('foo', 1, 2),
            new Item('bar', 0, 1),
        ];

        $mockRetriever = $this->createMock(FileContentRetriever::class);

        $mockRetriever->method('retrieveContent')
            ->with($filepath)
            ->willReturn($fileContent);

        $mockEncoder = $this->createMock(CsvEncoder::class);

        $mockEncoder->method('decode')
            ->with($fileContent, $fileType)
            ->willReturn($decodedContent);

        $mockNormalizer = $this->createMock(ItemsNormalizer::class);

        $mockNormalizer->method('denormalizeItems')
            ->with($decodedContent)
            ->willReturn($expectedContent);

        $repository = new ItemSerializer(
            $mockRetriever,
            $mockEncoder,
            $mockNormalizer
        );

        $repository->setItems($filepath, $fileType);
        $actualContent = $repository->getItems();

        $this->assertIsArray($actualContent, 'Return type for ItemSerializer class is not an array!');
        $this->assertEquals($expectedContent, $actualContent, 'ItemSerializer class does not return expected Content');
    }
}
