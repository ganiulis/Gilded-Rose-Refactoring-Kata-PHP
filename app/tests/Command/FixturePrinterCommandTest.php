<?php

namespace App\Tests\Command;

use ApprovalTests\Approvals;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class FixturePrinterCommandTest extends KernelTestCase
{
    public function testSuccess(): CommandTester
    {
        $kernel = self::bootKernel();

        $application = new Application($kernel);

        $command = $application->find('app:fixtures:print');

        $commandTester = new CommandTester($command);

        ob_start();

        $defaultSuccess = $commandTester->execute([]);

        $success = $commandTester->execute(['--days' => '5']);

        ob_end_clean();

        $this->assertTrue(!$defaultSuccess);
        $this->assertTrue(!$success);

        return $commandTester;
    }

    /**
     * @depends testSuccess
     */
    public function testDefaultPrint(CommandTester $commandTester): void
    {
        ob_start();
        
        $commandTester->execute([]);

        $output = ob_get_contents();

        ob_end_clean();

        Approvals::verifyString($output);
    }

    /**
     * @depends testSuccess
     */
    public function testPrint(CommandTester $commandTester): void
    {
        ob_start();
        
        $commandTester->execute(['--days' => '31']);

        $output = ob_get_contents();

        ob_end_clean();

        Approvals::verifyString($output);
    }

    /**
     * @depends testSuccess
     */
    public function testInvalidOption(CommandTester $commandTester): void
    {
        $invalid = $commandTester->execute(['--days' => 'thirty one']);

        $this->assertEquals(2, $invalid);
    }
}
