<?php

namespace App\Tests\Updater;

use App\Entity\Item;
use App\Updater\BackstageUpdater;
use PHPUnit\Framework\TestCase;

class BackstageUpdaterTest extends TestCase
{
    protected function setUp(): void
    {
        $this->updater = new BackstageUpdater();

        $this->item = new Item();
    }

    public function testSupportsTrue(): void
    {
        $this->item->setName('Backstage passes to a TAFKAL80ETC concert');

        $this->assertTrue($this->updater->supports($this->item));
    }

    public function testSupportsFalse(): void
    {
        $this->item->setName('An expired free pass');

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
                'quality increased by 1 when more than 11 days are left' => [
                    'name' => 'Backstage passes to a TAFKAL80ETC concert',        
                    'sellIn' => ['input' => 12, 'output' => 11],
                    'quality' => ['input' => 48, 'output' => 49],
                    'toString' => 'Backstage passes to a TAFKAL80ETC concert, 11, 49'
                ]
            ],
            [
                'quality maxxed when more than 11 days are left' => [
                    'name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'sellIn' => ['input' => 12, 'output' => 11],
                    'quality' => ['input' => 50, 'output' => 50],
                    'toString' => 'Backstage passes to a TAFKAL80ETC concert, 11, 50'
                ]
            ],
            [
                'quality increased by 2 when less than 12 days are left' => [
                    'name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'sellIn' => ['input' => 10, 'output' => 9],
                    'quality' => ['input' => 47, 'output' => 49],
                    'toString' => 'Backstage passes to a TAFKAL80ETC concert, 9, 49'
                ]
            ],
            [
                'quality maxxed when less than 12 days are left' => [
                    'name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'sellIn' => ['input' => 10, 'output' => 9],
                    'quality' => ['input' => 49, 'output' => 50],
                    'toString' => 'Backstage passes to a TAFKAL80ETC concert, 9, 50'
                ]
            ],
            [
                'quality increased by 3 when less than 6 days are left' => [
                    'name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'sellIn' => ['input' => 5, 'output' => 4],
                    'quality' => ['input' => 1, 'output' => 4],
                    'toString' => 'Backstage passes to a TAFKAL80ETC concert, 4, 4'
                ]
            ],
            [
                'quality maxxed when less than 6 days are left' => [
                    'name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'sellIn' => ['input' => 5, 'output' => 4],
                    'quality' => ['input' => 48, 'output' => 50],
                    'toString' => 'Backstage passes to a TAFKAL80ETC concert, 4, 50'
                ]
            ],
            [
                'quality dropped to 0 when item expired' => [
                    'name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'sellIn' => ['input' => 0, 'output' => -1],
                    'quality' => ['input' => 50, 'output' => 0],
                    'toString' => 'Backstage passes to a TAFKAL80ETC concert, -1, 0'
                ]
            ],
            [
                'quality dropped to 0 when when sellIn became negative' => [
                    'name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'sellIn' => ['input' => 0, 'output' => -1],
                    'quality' => ['input' => 1, 'output' => 0],
                    'toString' => 'Backstage passes to a TAFKAL80ETC concert, -1, 0'
                ]
            ],
            [
                'quality remained 0 when when sellIn is negative' => [
                    'name' => 'Backstage passes to a TAFKAL80ETC concert',
                    'sellIn' => ['input' => -1, 'output' => -2],
                    'quality' => ['input' => 0, 'output' => 0],
                    'toString' => 'Backstage passes to a TAFKAL80ETC concert, -2, 0'
                ]
            ]
        ];
    }
}
