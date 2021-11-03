<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use GildedRose\Command\TestFixtureCommand;

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

        $expectedFixture = file_get_contents(__DIR__ . '/approvals/ApprovalDefaultTest.testTestFixture.approved.txt');
        
        $this->assertEquals($expectedFixture, $actualFixture, 'Fixture test default command line output does not match expected output!');
    }
}
