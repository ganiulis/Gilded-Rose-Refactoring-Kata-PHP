<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;

class StockManagerApprovalDefaultTest extends TestCase
{
    public function testTestDefaultFixture(): void
    {
        exec('php fixtures/texttest_fixture.php', $output);

        $implodedFixture = implode("\n", $output);

        $actualFixture = $implodedFixture . "\n";

        Approvals::verifyString($actualFixture);
    }
}
