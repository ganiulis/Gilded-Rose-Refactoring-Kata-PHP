<?php

namespace Tests\Repository;

use GildedRose\Data\FileContentRetriever;
use GildedRose\Item;
use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\Repository\ItemRepository;

use PHPUnit\Framework\TestCase;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemRepositoryTest extends TestCase
{
    public function testItemRepository(): void
    {
        $filepath = 'filepath/to/content';
        $fileContent = 'content in a string';
        $fileType = 'filetype';
        $decodedContent = ['this', 'is', 'an', 'array'];
        $expectedContent = [
            new Item('foo', 1, 2),
            new Item('bar', 0, 1),
        ];

        $mockRetriever = $this->getMockBuilder(FileContentRetriever::class)
            ->getMock();

        $mockRetriever->method('retrieveContent')
            ->with($filepath)
            ->willReturn($fileContent);

        $mockEncoder = $this->getMockBuilder(CsvEncoder::class)
            ->getMock();

        $mockEncoder->method('decode')
            ->with($fileContent, $fileType)
            ->willReturn($decodedContent);

        $mockNormalizer = $this->getMockBuilder(ItemsNormalizer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockNormalizer->method('denormalizeItems')
            ->with($decodedContent)
            ->willReturn($expectedContent);

        $repository = new ItemRepository(
            $mockRetriever,
            $mockEncoder,
            $mockNormalizer
        );

        $repository->setItems($filepath, $fileType);
        $actualContent = $repository->getItems();

        $this->assertIsArray($actualContent, 'Return type for ItemRepository class is not an array!');
        $this->assertEquals($expectedContent, $actualContent, 'ItemRepository class does not return expected Content');
    }
}
