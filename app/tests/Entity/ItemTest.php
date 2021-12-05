<?php 

namespace App\Tests\Entity;

use App\Entity\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testEntity(): Item
    {
        $itemData =[
            'id' => 0,
            'name' => 'alpha',
            'sellIn' => 0,
            'quality' => 2
        ];

        $item = new Item();

        $item->setId($itemData['id']);
        $this->assertIsInt($item->getId());
        $this->assertEquals($item->getId(), $itemData['id']);

        $item->setName($itemData['name']);
        $this->assertIsString($item->getName());
        $this->assertEquals($item->getName(), $itemData['name']);
        
        $item->setSellIn($itemData['sellIn']);
        $this->assertIsInt($item->getSellIn());
        $this->assertEquals($item->getSellIn(), $itemData['sellIn']);
        
        $item->setQuality($itemData['quality']);
        $this->assertIsInt($item->getSellIn());
        $this->assertEquals($item->getQuality(), $itemData['quality']);
        
        return $item;
    }

    /**
     * @depends testEntity
     */
    public function testToString(Item $item): void
    {
        $this->assertisString($item->__toString());
        $this->assertEquals($item->__toString(), 'alpha, 0, 2');
    }
}
