<?php

namespace App\Tests\Updater;

use App\Entity\Item;
use App\Updater\DefaultUpdater;
use PHPUnit\Framework\TestCase;

class DefaultUpdaterTest extends TestCase
{
    protected function setUp(): void
    {
        $this->updater = new DefaultUpdater();

        $this->item = new Item();
    }

    public function testSupportsTrue(): void
    {
        $this->item->setName('Any item with any name');

        $this->assertTrue($this->updater->supports($this->item));
    }

    /**
     * @dataProvider provider
    */
    public function testUpdate(array $itemData): void
    {
        $this->item->setName($itemData['name']);
        $this->item->setSellIn($itemData['sellIn']['input']);
        $this->item->setQuality($itemData['quality']['input']);

        $this->updater->update($this->item);

        $this->assertEquals($itemData['sellIn']['output'], $this->item->getSellIn());
        $this->assertEquals($itemData['quality']['output'], $this->item->getQuality());

        $this->assertEquals($itemData['toString'], $this->item->__toString());
    }

    public function provider(): array 
    {
        return [
            [
                'quality decreased by 1 when sellIn decreased by 1' => [
                    'name' => 'Apple pie',        
                    'sellIn' => ['input' => 2, 'output' => 1],
                    'quality' => ['input' => 2, 'output' => 1],
                    'toString' => 'Apple pie, 1, 1'
                ]
            ],
            [
                'quality decreased by 1 when sellIn decreased to 0' => [
                    'name' => 'Banana pie', 
                    'sellIn' => ['input' => 1, 'output' => 0],
                    'quality' => ['input' => 2, 'output' => 1],
                    'toString' => 'Banana pie, 0, 1'
                ]
            ],
            [
                'quality decreased by 2 when item expired' => [
                    'name' => 'Cherry pie',
                    'sellIn' => ['input' => 0, 'output' => -1],
                    'quality' => ['input' => 2, 'output' => 0],
                    'toString' => 'Cherry pie, -1, 0'
                ]
            ],
            [
                'quality decreased to 0 when sellIn is negative' => [
                    'name' => 'Date pie',
                    'sellIn' => ['input' => 0, 'output' => -1],
                    'quality' => ['input' => 1, 'output' => 0],
                    'toString' => 'Date pie, -1, 0'
                ]
            ]
        ];
    }
}
