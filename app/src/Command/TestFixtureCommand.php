<?php

declare(strict_types=1);

Namespace GildedRose\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

use GildedRose\Serializer\ItemNormalizer;
use GildedRose\Serializer\ItemsNormalizer;
use GildedRose\GildedRose;
use GildedRose\Repository\ItemRepository;

class TestFixtureCommand extends Command
{
    protected static $defaultName = 'test-fixture';

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
        $days = $input->getOption('days');

        $itemRepository = new ItemRepository(new CsvEncoder, new ItemsNormalizer(new ItemNormalizer), '/app/data/testfixture.csv');

        $items = $itemRepository->getItems();

        $output->writeln('OMGHAI!');

        $itemsUpdater = new GildedRose($items);

        for ($i = 0; $i < $days; $i++) {
            $output->writeln([
                "-------- day ${i} --------",
                'name, sellIn, quality'
            ]);
            foreach ($items as $item) {
                $output->writeln($item);
            }
            $output->writeln('');
            $itemsUpdater->updateQuality();
        }

        return Command::SUCCESS;
    }
}
