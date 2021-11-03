<?php

declare(strict_types=1);

namespace GildedRose\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use GildedRose\GildedRose;
use GildedRose\Item;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

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
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);

        $encodedFixtureData = file_get_contents(__DIR__ . "\\..\\..\\data\\testfixture.csv");

        $decodedFixtureData = $serializer->decode($encodedFixtureData, 'csv');
        
        for ($i = 0; $i < count($decodedFixtureData); $i++) {
            $items[] = new Item(
                $decodedFixtureData[$i]['name'],
                intval($decodedFixtureData[$i]['sellIn']),
                intval($decodedFixtureData[$i]['quality'])
            );
        }

        $days = $input->getOption('days');

        $output->writeln('OMGHAI!');

        $app = new GildedRose($items);

        for ($i = 0; $i < $days; $i++) {
            $output->writeln([
                "-------- day ${i} --------",
                'name, sellIn, quality'
            ]);
            foreach ($items as $item) {
                $output->writeln($item);
            }
            $output->writeln('');
            $app->updateQuality();
        }

        return Command::SUCCESS;
    }
}
