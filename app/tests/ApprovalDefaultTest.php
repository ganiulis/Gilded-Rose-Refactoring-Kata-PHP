<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;

class ApprovalDefaultTest extends TestCase
{
    public function testTestFixture(): void
    {
        exec('php fixtures/texttest_fixture.php', $output);

        $implodedFixture = implode("\n", $output);

        Approvals::verifyString($implodedFixture);
    }
}
