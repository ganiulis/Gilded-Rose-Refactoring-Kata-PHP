<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$application = new Application('Gilded Rose CLI Fixture Processor', '0.1.0');

class TestFixtureCommand extends Command
{
    protected static $defaultName = 'test-fixture';
    
    protected function configure(): void
    {
        $this
            ->setDescription('Fixture testing through the terminal')
            ->setHelp('This command allows you to try processing the test fixture for n days')
            ->addOption('days', 'd', $this->requirePassword ? InputOption::VALUE_REQUIRED : InputOption::VALUE_OPTIONAL, 'How many days will the fixture be updated for?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $days = $input->getOption('days');
        
        exec('php fixtures/texttest_fixture.php ' . $days, $fixtureOutput);

        $output->writeln($fixtureOutput);

        return Command::SUCCESS;
    }
}

$application->add(new TestFixtureCommand());

$application->run();
