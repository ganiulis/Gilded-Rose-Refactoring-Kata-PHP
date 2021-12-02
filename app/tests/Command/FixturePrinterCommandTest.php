<?php

declare(strict_types=1);

namespace App\Tests\Command;


use ApprovalTests\Approvals;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class FixturePrinterCommandTest extends KernelTestCase
{
    public function testSuccessfulPrint(): void
    {
        $kernel = self::bootKernel();

        $application = new Application($kernel);

        $command = $application->find('app:fixtures:print');

        $commandTester = new CommandTester($command);

        ob_start();
        
        $success = $commandTester->execute(['--days' => '31']);

        $output = ob_get_contents();

        ob_end_clean();

        $this->assertTrue(!$success);

        Approvals::verifyString($output);
    }

    public function testSuccessfulDefaultPrint(): void
    {
        $kernel = self::bootKernel();

        $application = new Application($kernel);

        $command = $application->find('app:fixtures:print');

        $commandTester = new CommandTester($command);

        ob_start();
        
        $success = $commandTester->execute([]);

        $output = ob_get_contents();

        ob_end_clean();

        $this->assertTrue(!$success);

        Approvals::verifyString($output);
    }

    public function testInvalidOption(): void
    {
        $kernel = self::bootKernel();

        $application = new Application($kernel);

        $command = $application->find('app:fixtures:print');

        $commandTester = new CommandTester($command);

        $invalid = $commandTester->execute(['--days' => 'thirty one']);

        $this->assertEquals(2, $invalid);
    }
}
