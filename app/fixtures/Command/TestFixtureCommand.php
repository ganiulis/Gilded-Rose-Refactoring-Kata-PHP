<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\Item;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$application = new Application('Gilded Rose CLI Fixture Processor', '0.1.0');

class TestFixtureCommand extends Command
{
    protected static $defaultName = 'test-fixture';
    
    private const DEFAULT_DESCRIPTION = 'Process items';
    private const HELP_DESCRIPTION = 'This command allows you to try processing items via the updateQuality() method for n days';

    protected function configure(): void
    {
        $this
            ->setDescription($this::DEFAULT_DESCRIPTION)
            ->setHelp($this::HELP_DESCRIPTION)
            ->addOption('days', 'd', InputOption::VALUE_OPTIONAL, 'How many days will this item set be updated for?', 2)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $items = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('Aged Brie', 2, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
            new Item('Conjured Mana Cake', 3, 6),
        ];

        $app = new GildedRose($items);

        $output->write('OMGHAI!', true);

        $days = $input->getOption('days');
        
        for ($i = 0; $i < $days; $i++) {
            $output->writeln([
                "-------- day ${i} --------",
                "name, sellIn, quality"
            ]);
            foreach ($items as $item) {
                    $output->write($item, true);
                }
            $output->write('', true);
            $app->updateQuality();            
        }

        return Command::SUCCESS;
    }
}

$application->add(new TestFixtureCommand());

$application->run();
