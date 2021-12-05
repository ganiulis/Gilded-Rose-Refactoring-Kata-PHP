<?php

namespace App\Tests\Updater;

use App\Entity\Item;
use App\Updater\BrieUpdater;
use PHPUnit\Framework\TestCase;

class BrieUpdaterTest extends TestCase
{
    protected function setUp(): void
    {
        $this->updater = new BrieUpdater();

        $this->item = new Item();
    }

    public function testSupportsTrue(): void
    {
        $this->item->setName('Aged brie');

        $this->assertTrue($this->updater->supports($this->item));
    }

    public function testSupportsFalse(): void
    {
        $this->item->setName('Pumpkin pie');

        $this->assertFalse($this->updater->supports($this->item));
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
                'quality increased by 1 when sellIn is positive' => [
                    'name' => 'Aged brie',        
                    'sellIn' => ['input' => 2, 'output' => 1],
                    'quality' => ['input' => 2, 'output' => 3],
                    'toString' => 'Aged brie, 1, 3'
                ]
            ],
            [
                'quality remains at max when sellIn is positive' => [
                    'name' => 'Aged brie',
                    'sellIn' => ['input' => 2, 'output' => 1],
                    'quality' => ['input' => 50, 'output' => 50],
                    'toString' => 'Aged brie, 1, 50'
                ]
            ],
            [
                'quality increased by 1 when item expired' => [
                    'name' => 'Aged brie', 
                    'sellIn' => ['input' => 1, 'output' => 0],
                    'quality' => ['input' => 2, 'output' => 3],
                    'toString' => 'Aged brie, 0, 3'
                ]
            ],
            [
                'quality increased by 2 when sellIn is negative' => [
                    'name' => 'Aged brie',
                    'sellIn' => ['input' => 0, 'output' => -1],
                    'quality' => ['input' => 2, 'output' => 4],
                    'toString' => 'Aged brie, -1, 4'
                ]
            ],
            [
                'quality maxxed when sellIn is negative' => [
                    'name' => 'Aged brie',
                    'sellIn' => ['input' => 0, 'output' => -1],
                    'quality' => ['input' => 48, 'output' => 50],
                    'toString' => 'Aged brie, -1, 50'
                ]
            ]
        ];
    }
}
