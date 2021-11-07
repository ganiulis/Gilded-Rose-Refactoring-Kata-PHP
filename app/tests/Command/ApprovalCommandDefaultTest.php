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

class ApprovalCommandDefaultTest extends TestCase
{
    public function testTestFixtureDefaultCommand(): void
    {
        $actualFileInfo = new SplFileInfo(__DIR__ . '/../../data/testfixture.csv');
        $actualFilePath = $actualFileInfo->getRealPath();
        
        $application = new Application('Gilded Rose CLI default fixture tester', '0.1.1');

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

        $commandTester->execute([]);

        $output = $commandTester->getDisplay();

        $actualFixture = str_replace("\n", "\r\n", $output);

        $expectedFixtureInfo = new SplFileInfo(__DIR__ . '/../approvals/ApprovalDefaultTest.testTestDefaultFixture.approved.txt');
        $expectedFixturePath = $expectedFixtureInfo->getRealPath();
        $expectedFixture = file_get_contents($expectedFixturePath);
        
        $this->assertEquals($expectedFixture, $actualFixture, 'Fixture test default command line output does not match expected output!');
    }
}
