<?php 

namespace App\Tests\Updater;

use App\Entity\Item;
use App\Updater\ConjuredUpdater;
use App\Updater\DefaultUpdater;
use App\Updater\UpdaterManager;
use PHPUnit\Framework\TestCase;

class UpdaterManagerTest extends TestCase
{
    public function testUpdateAll(): void
    {
        $itemsData =[
            'default' => [
                'name' => 'alpha',
                'sellIn' => 0,
                'quality' => 2
            ],
            'special' => [
                'name' => 'bravo',
                'sellIn' => 1,
                'quality' => 0
            ]
        ];

        $defaultItem = new Item();

        $defaultItem->setName($itemsData['default']['name']);
        $defaultItem->setSellIn($itemsData['default']['sellIn']);
        $defaultItem->setQuality($itemsData['default']['quality']);

        $specialItem = new Item();

        $specialItem->setName($itemsData['special']['name']);
        $specialItem->setSellIn($itemsData['special']['sellIn']);
        $specialItem->setQuality($itemsData['special']['quality']);

        $mockDefaultUpdater = $this->createMock(DefaultUpdater::class);
        $mockDefaultUpdater->expects($this->once())
            ->method('update')
            ->with($defaultItem)
            ->willReturn(new Item());

        $mockSpecialUpdater = $this->createMock(ConjuredUpdater::class);
        $mockSpecialUpdater->expects($this->once())
            ->method('update')
            ->with($specialItem)
            ->willReturn(new Item());

        $mockSpecialUpdater->expects($this->exactly(2))
            ->method('supports')
            ->withConsecutive(
                [$defaultItem],
                [$specialItem]
            )
            ->willReturnOnConsecutiveCalls(
                false,
                true
            );

        $manager = new UpdaterManager(
            $mockDefaultUpdater,
            [
                $mockSpecialUpdater
            ]
        );

        $items = [
            $defaultItem,
            $specialItem
        ];

        $updatedItems = $manager->updateAll($items);

        $this->assertIsArray($updatedItems, 'UpdaterManager did not return an array!');
    }
}
