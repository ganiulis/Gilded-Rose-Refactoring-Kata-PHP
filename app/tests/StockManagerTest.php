<?php 

namespace App\Tests\Updater;

use App\Entity\Item;
use App\StockManager;
use App\Updater;
use PHPUnit\Framework\TestCase;

class StockManagerTest extends TestCase
{
    public function testUpdateAll(): void
    {
        $testItems = [
            new Item('foo', 4, 3),
            new Item('bar', 5, 2)
        ];

        $mockDefaultUpdater = $this->createMock(Updater\DefaultUpdater::class);

        $mockDefaultUpdater->expects($this->once())
            ->method('update')
            ->with($testItems[1])
            ->willReturn(new Item('bar', 4, 1));

        $mockUpdater = $this->createMock(Updater\BackstageUpdater::class);

        $mockUpdater->expects($this->exactly(2))
            ->method('supports')
            ->withConsecutive(
                [$testItems[0]],
                [$testItems[1]]
            )
            ->willReturnOnConsecutiveCalls(
                true,
                false
            );
        $mockUpdater->expects($this->once())
            ->method('update')
            ->with($testItems[0])
            ->willReturn(new Item('foo', 3, 2));

        $manager = new StockManager(
            $mockDefaultUpdater,
            [
                $mockUpdater
            ]
        );

        $manager->updateAll($testItems);
    }
}
