<?php

declare(strict_types=1);

namespace GildedRose\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use GildedRose\StockManager;
use GildedRose\Repository\ItemRepository;
use GildedRose\Updater\ConjuredUpdater;
use GildedRose\Updater\SulfurasUpdater;

class TestFixtureCommand extends Command
{
    protected static $defaultName = 'test-fixture';

    /**
     * Tester for the Item repository class. Used for testing fixture files.
     *
     * @param ItemRepository $itemRepository the actual Item repository class
     */
    public function __construct(ItemRepository $itemRepository)
    {
        parent::__construct();
        $this->itemRepository = $itemRepository;
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
        $filepath = __DIR__ . '/../../data/testfixture.csv';

        $this->itemRepository->setItems($filepath, 'csv');
        $items = $this->itemRepository->getItems();

        $days = $input->getOption('days');
        
        $stockManager = new StockManager();

        echo 'OMGHAI!' . PHP_EOL;

        for ($i = 0; $i < intval($days); $i++) {
            echo "-------- day ${i} --------" . PHP_EOL;
            echo 'name, sellIn, quality' . PHP_EOL;
            foreach ($items as $item) {
                echo $item . PHP_EOL;
            }
            echo PHP_EOL;
            $stockManager->updateAll($items);
        }

        return Command::SUCCESS;
    }
}
