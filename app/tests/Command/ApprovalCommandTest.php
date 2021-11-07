<?php

declare(strict_types=1);

namespace Tests\Command;

use GildedRose\Command\TestFixtureCommand;
use GildedRose\Repository\ItemRepository;
use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;

use PHPUnit\Framework\TestCase;

use SplFileInfo;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ApprovalCommandTest extends TestCase
{
    public function testTestFixtureCommand(): void
    {
        $actualFileInfo = new SplFileInfo(__DIR__ . '/../../data/testfixture.csv');
        $actualFilePath = $actualFileInfo->getRealPath();

        $application = new Application('Gilded Rose CLI fixture tester', '0.1.1');

        $command = $application->add(
            new TestFixtureCommand(
                new ItemRepository(
                    new CsvEncoder,
                    new ItemsNormalizer(new ItemNormalizer),
                    $actualFilePath,
                    'csv'
                )
            )
        );

        $commandTester = new CommandTester($command);

        $commandTester->execute(['--days' => '31']);

        $output = $commandTester->getDisplay();

        $actualFixture = str_replace("\n", "\r\n", $output);

        $expectedFixtureInfo = new SplFileInfo(__DIR__ . '/../approvals/ApprovalTest.testTestFixture.approved.txt');
        $expectedFixturePath = $expectedFixtureInfo->getRealPath();
        $expectedFixture = file_get_contents($expectedFixturePath);

        $this->assertEquals($expectedFixture, $actualFixture, 'Fixture test command line output does not match expected output!');
    }
}
