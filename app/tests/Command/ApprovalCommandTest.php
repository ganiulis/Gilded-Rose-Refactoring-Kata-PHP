<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Command\TestFixtureCommand;

use SplFileInfo;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ApprovalCommandTest extends TestCase
{
    public function testTestFixtureCommand(): void
    {
        $application = new Application('Gilded Rose CLI fixture tester', '0.1.0');

        $command = $application->add(new TestFixtureCommand());

        $commandTester = new CommandTester($command);

        $commandTester->execute(['--days' => '31']);

        $output = $commandTester->getDisplay();

        $actualFixture = str_replace("\n", "\r\n", $output);

        $info = new SplFileInfo('tests/approvals/ApprovalTest.testTestFixture.approved.txt');
        $dir = $info->getRealPath();
        $expectedFixture = file_get_contents($dir);
        
        $this->assertEquals($expectedFixture, $actualFixture, 'Fixture test command line output does not match expected output!');
    }
}
