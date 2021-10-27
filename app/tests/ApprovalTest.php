<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;

class ApprovalTest extends TestCase
{
    public function testTestFixture(): void
    {
        // executes fixtures file for 31 days and stores the results in $output array
        exec('php fixtures/texttest_fixture.php 31', $output);
        
        // compares imploded output with the text file in approvals
        // currently conjured items don't work, so until refactoring is complete will degrade as any other generic item
        Approvals::verifyString(implode(PHP_EOL, $output));
    }
}