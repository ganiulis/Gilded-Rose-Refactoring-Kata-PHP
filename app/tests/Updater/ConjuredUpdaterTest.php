<?php

namespace App\Tests\Updater;

use App\Entity\Item;
use App\Updater\ConjuredUpdater;
use PHPUnit\Framework\TestCase;

class ConjuredUpdaterTest extends TestCase
{
    protected function setUp(): void
    {
        $this->updater = new ConjuredUpdater();

        $this->item = new Item();
    }

    /**
     * @dataProvider provider
    */
    public function testSupportsTrue(array $itemData): void
    {
        $this->item->setName($itemData['name']);

        $this->assertTrue($this->updater->supports($this->item));
    }

    public function testSupportsFalse(): void
    {
        $this->item->setName('Nonconjured dish');

        $this->assertFalse($this->updater->supports($this->item));

        $this->item->setName('Another kind of dish');
     
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
                'quality decreased by 2 when sellin is positive' => [
                    'name' => 'Conjured apple pie',        
                    'sellIn' => ['input' => 2, 'output' => 1],
                    'quality' => ['input' => 5, 'output' => 3],
                    'toString' => 'Conjured apple pie, 1, 3'
                ]
            ],
            [
                'quality decreased by 2 when sellin is positive' => [
                    'name' => 'Conjured cherry pie',
                    'sellIn' => ['input' => 2, 'output' => 1],
                    'quality' => ['input' => 3, 'output' => 1],
                    'toString' => 'Conjured cherry pie, 1, 1'
                ]
            ],
            [
                'quality decreased to 0 when sellin is positive' => [
                    'name' => 'Conjured date pie',
                    'sellIn' => ['input' => 2, 'output' => 1],
                    'quality' => ['input' => 2, 'output' => 0],
                    'toString' => 'Conjured date pie, 1, 0'
                ]
            ],
            [
                'quality decreased by 2 when sellIn is positive' => [
                    'name' => 'Conjured elderberry pie',
                    'sellIn' => ['input' => 2, 'output' => 1],
                    'quality' => ['input' => 3, 'output' => 1],
                    'toString' => 'Conjured elderberry pie, 1, 1'
                ]
            ],
            [
                'quality decreased by 4 when item expired' => [
                    'name' => 'Conjured fig pie',
                    'sellIn' => ['input' => 0, 'output' => -1],
                    'quality' => ['input' => 5, 'output' => 1],
                    'toString' => 'Conjured fig pie, -1, 1'
                ]
            ],
            [
                'quality decreased to 0 when sellIn is negative' => [
                    'name' => 'Conjured gullet pie',
                    'sellIn' => ['input' => 0, 'output' => -1],
                    'quality' => ['input' => 3, 'output' => 0],
                    'toString' => 'Conjured gullet pie, -1, 0'
                ]
            ]
        ];
    }
}
