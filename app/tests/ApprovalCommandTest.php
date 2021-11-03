<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use GildedRose\Command\TestFixtureCommand;

class ApprovalCommandTest extends TestCase
{
    public function testTestFixtureCommand(): void
    {
        $application = new Application('Gilded Rose CLI fixture tester', '0.1.0');

        $command = $application->add(new TestFixtureCommand());

        $commandTester = new CommandTester($command);

        $commandTester->execute([
            '--days' => '31'
        ]);

        $output = $commandTester->getDisplay(true);

        $actualFixture = str_replace("\n", "\r\n", $output);

        $expectedFixture = file_get_contents(__DIR__ . '/approvals/ApprovalTest.testTestFixture.approved.txt');
        
        $this->assertEquals($expectedFixture, $actualFixture, 'Fixture test command line output does not match expected output!');
    }
}
