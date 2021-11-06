<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Command\TestFixtureCommand;

use SplFileInfo;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ApprovalCommandDefaultTest extends TestCase
{
    public function testTestFixtureDefaultCommand(): void
    {
        $application = new Application('Gilded Rose CLI default fixture tester', '0.1.0');

        $command = $application->add(new TestFixtureCommand());

        $commandTester = new CommandTester($command);

        $commandTester->execute([]);

        $output = $commandTester->getDisplay();

        $actualFixture = str_replace("\n", "\r\n", $output);

        $info = new SplFileInfo('tests/approvals/ApprovalDefaultTest.testTestDefaultFixture.approved.txt');
        $dir = $info->getRealPath();
        $expectedFixture = file_get_contents($dir);
        
        $this->assertEquals($expectedFixture, $actualFixture, 'Fixture test default command line output does not match expected output!');
    }
}
