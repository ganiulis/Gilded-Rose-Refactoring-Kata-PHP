<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\TestFixtureCommand;
use App\Data\FileContentRetriever;
use App\Printer\StockPrinter;
use App\Repository\ItemRepository;
use App\Serializer\ItemNormalizer;
use App\Serializer\ItemsNormalizer;
use App\StockManager;
use App\Updater;
use PHPUnit\Framework\TestCase;

use SplFileInfo;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class StockManagerDefaultApprovalTest extends TestCase
{
    public function testStockManagerDefaultApproval(): void
    {
        $application = new Application('Gilded Rose CLI default fixture tester', '0.2.0');

        $command = $application->add(
            new TestFixtureCommand(
                new ItemRepository(
                    new FileContentRetriever(),
                    new CsvEncoder(), 
                    new ItemsNormalizer(new ItemNormalizer())
                ),
                new StockManager(
                    new Updater\DefaultUpdater(),
                    [
                        new Updater\BackstageUpdater(),
                        new Updater\BrieUpdater(),
                        new Updater\ConjuredUpdater(),
                        new Updater\SulfurasUpdater()
                    ]
                ),
                new StockPrinter()
            )
        );

        $commandTester = new CommandTester($command);

        ob_start();

        $commandTester->execute([]);
        
        $output = ob_get_contents();

        ob_end_clean();

        $actualFixture = str_replace("\n", "\r\n", $output);

        $expectedFixtureInfo = new SplFileInfo(__DIR__ . '/../approvals/StockManagerApprovalDefaultTest.testTestDefaultFixture.approved.txt');
        $expectedFixturePath = $expectedFixtureInfo->getRealPath();
        $expectedFixture = file_get_contents($expectedFixturePath);

        $this->assertEquals($expectedFixture, $actualFixture, 'Fixture test command line output does not match expected output!');
    }
}
