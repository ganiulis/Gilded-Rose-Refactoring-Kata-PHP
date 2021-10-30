<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;

class ApprovalCommandTest extends TestCase
{
    public function testTestFixtureCommand(): void
    {
        exec('php fixtures/Command/TestFixtureCommand.php test-fixture --days=31', $output);

        $implodedFixture = implode("\n", $output);

        Approvals::verifyString($implodedFixture);
    }
}
