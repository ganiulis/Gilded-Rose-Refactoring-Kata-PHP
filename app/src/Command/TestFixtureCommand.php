<?php

declare(strict_types=1);

namespace GildedRose\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\DataDecoder;

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

        $decoder = new DataDecoder();

        $decodedFixtureData = $decoder->retrieveData('testfixture.csv', 'csv');

        foreach ($decodedFixtureData as $dataItem) {
            $items[] = new Item(
                $dataItem['name'],
                intval($dataItem['sellIn']),
                intval($dataItem['quality'])
            );
        }

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
