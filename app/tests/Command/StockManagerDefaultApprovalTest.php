<?php

declare(strict_types=1);

namespace Tests\Command;

use GildedRose\Command\TestFixtureCommand;
use GildedRose\Data\FileContentRetriever;
use GildedRose\Repository\ItemRepository;
use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;

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
                    new FileContentRetriever,
                    new CsvEncoder, 
                    new ItemsNormalizer(new ItemNormalizer)
                )
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
