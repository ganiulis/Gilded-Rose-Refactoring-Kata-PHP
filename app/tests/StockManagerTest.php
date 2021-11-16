<?php 

namespace Tests\Updater;

use GildedRose\Item;
use GildedRose\StockManager;
use GildedRose\Updater;
use GildedRose\Validator\QualityValidator;
use PHPUnit\Framework\TestCase;

class StockProcesssorTest extends TestCase
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

        $mockValidator = $this->createMock(QualityValidator::class);

        $mockValidator->expects($this->exactly(2))
            ->method('validate')
            ->withConsecutive(
                [$testItems[0]],
                [$testItems[1]]
            )
            ->willReturnOnConsecutiveCalls(
                new Item('foo', 3, 2),
                new Item('bar', 4, 1)
            );

        $manager = new StockManager(
            $mockDefaultUpdater,
            [
                $mockUpdater
            ],
            $mockValidator
        );

        $manager->updateAll($testItems);
        $manager->validateAll($testItems);
    }
}
