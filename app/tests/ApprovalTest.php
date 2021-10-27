<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;

class ApprovalTest extends TestCase
{
    public function testTestFixture(): void
    {
        exec('php fixtures/texttest_fixture.php 31', $output);
        
        Approvals::verifyString(implode(PHP_EOL, $output));
    }
}