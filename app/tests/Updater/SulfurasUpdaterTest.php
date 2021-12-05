<?php

namespace App\Tests\Updater;

use App\Entity\Item;
use App\Updater\SulfurasUpdater;
use PHPUnit\Framework\TestCase;

class SulfurasTest extends TestCase
{
    protected function setUp(): void
    {
        $this->updater = new SulfurasUpdater();

        $this->item = new Item();
    }

    public function testSupportsTrue(): void
    {
        $this->item->setName('Sulfuras, Hand of Ragnaros');

        $this->assertTrue($this->updater->supports($this->item));
    }

    public function testSupportsFalse(): void
    {
        $this->item->setName('Sandals of the Insurgent');

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
                'nothing changed' => [
                    'name' => 'Sulfuras, Hand of Ragnaros',        
                    'sellIn' => ['input' => 1, 'output' => 1],
                    'quality' => ['input' => 80, 'output' => 80],
                    'toString' => 'Sulfuras, Hand of Ragnaros, 1, 80'
                ]
            ],
            [
                'nothing changed' => [
                    'name' => 'Sulfuras, Hand of Ragnaros', 
                    'sellIn' => ['input' => -1, 'output' => -1],
                    'quality' => ['input' => 80, 'output' => 80],
                    'toString' => 'Sulfuras, Hand of Ragnaros, -1, 80'
                ]
            ],
            [
                'quality fixed if it was not 80' => [
                    'name' => 'Sulfuras, Hand of Ragnaros',
                    'sellIn' => ['input' => -1, 'output' => -1],
                    'quality' => ['input' => 45, 'output' => 80],
                    'toString' => 'Sulfuras, Hand of Ragnaros, -1, 80'
                ]
            ]
        ];
    }
}
