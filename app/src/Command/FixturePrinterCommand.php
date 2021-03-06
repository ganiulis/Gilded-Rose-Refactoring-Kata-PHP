<?php

declare(strict_types=1);

namespace App\Command;

use App\Printer\StockPrinter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use App\Updater\UpdaterManager;
use App\Serializer\SerializerInterface;

class FixturePrinterCommand extends Command
{
    public function __construct(
        SerializerInterface $serializer,
        UpdaterManager $manager,
        StockPrinter $printer
    ) {
        $this->serializer = $serializer;
        $this->manager = $manager;
        $this->printer = $printer;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Fixture testing through the terminal')
            ->setHelp('This command allows you to try processing the test fixture for n days')
            ->addOption('days', 'd', InputOption::VALUE_OPTIONAL, 'How many days will the fixture be updated for?', 2)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filepath = __DIR__ . '/../Data/fixture.csv';

        $items = $this->serializer->deserialize($filepath, 'csv');

        $days = $input->getOption('days');

        if (!is_numeric($days)) {
            return Command::INVALID;
        }

        $this->printer->printIntro();
        
        for ($day = 0; $day < $days; $day++) {
            $this->printer->printSummary($items, $day);

            $this->manager->updateAll($items);
        }

        return Command::SUCCESS;
    }
}
