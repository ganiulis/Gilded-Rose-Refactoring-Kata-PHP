<?php

declare(strict_types=1);

namespace App\Command;

use App\Printer\StockPrinter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use App\StockManager;
use App\Repository\ItemOldRepository;

class TestFixtureCommand extends Command
{
    protected static $defaultName = 'test-fixture';

    /**
     * Tester for the Item repository class. Used for testing fixture files.
     *
     * @param ItemOldRepository $ItemOldRepository the actual Item repository class
     */
    public function __construct(
        ItemOldRepository $ItemOldRepository,
        StockManager $stockManager,
        StockPrinter $stockPrinter
    ) {
        parent::__construct();
        $this->ItemOldRepository = $ItemOldRepository;
        $this->stockManager = $stockManager;
        $this->stockPrinter = $stockPrinter;
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
        $filepath = __DIR__ . '/../DataFixtures/testfixture.csv';

        $this->ItemOldRepository->setItems($filepath, 'csv');
        $items = $this->ItemOldRepository->getItems();

        $days = $input->getOption('days');

        $this->stockPrinter->printIntro();
        
        for ($day = 0; $day < $days; $day++) {
            $this->stockPrinter->printSummary($items, $day);
            $this->stockManager->updateAll($items);
        }

        return Command::SUCCESS;
    }
}
