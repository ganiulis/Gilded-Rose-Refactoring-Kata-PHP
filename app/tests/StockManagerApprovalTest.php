<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;

class StockManagerApprovalTest extends TestCase
{
    public function testTestFixture(): void
    {
        exec('php fixtures/texttest_fixture.php 31', $output);

        $implodedFixture = implode("\n", $output);

        $actualFixture = $implodedFixture . "\n";

        Approvals::verifyString($actualFixture);
    }
}
