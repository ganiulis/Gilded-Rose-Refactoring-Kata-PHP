<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

class ApprovalCommandTest extends TestCase
{
    public function testTestFixtureCommand(): void
    {
        $expectedFixture = file_get_contents(__DIR__ . '/approvals/ApprovalTest.testTestFixture.approved.txt');
        
        exec('php app test-fixture --days=31', $output);

        $actualFixture = implode("\r\n", $output);

        $this->assertEquals($expectedFixture, $actualFixture, 'Fixture command line output (actual) does not match approvals text file input (expected)!');
    }
}
