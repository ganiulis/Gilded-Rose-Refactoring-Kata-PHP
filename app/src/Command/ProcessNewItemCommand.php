<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\Item;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

$application = new Application('Gilded Rose CLI Item Processor', '0.0.1');

class CreateNewItemCommand extends Command
{
    protected static $defaultName = 'app:process-new-item';
    
    private const DEFAULT_DESCRIPTION = 'Process a new item';
    private const HELP_DESCRIPTION = 'This command allows you to try processing a new item via updateQuality() method for n days';

    private const NAME_QUESTION = 'What is the name of the item? ';
    private const SELL_IN_QUESTION = 'In how many days will the item expire? (int) ';
    private const QUALITY_QUESTION = 'What is the quality of the item? (int) ';
    private const DAYS_QUESTION = 'How many days should pass? (int) ';

    private const HORIZONTAL_BAR_OUTPUT = '=============================';
    private const PROCESS_SUCCESS_OUTPUT = '<info>Item processed!</info>';
    private const NAME_OUTPUT = '<comment>Name:</comment>            ';
    private const SELL_IN_OUTPUT = '<comment>Expiration:</comment>      ';
    private const QUALITY_OUTPUT = '<comment>Current quality:</comment> ';
    private const DAYS_OUTPUT = '<comment>Days passed:</comment>     ';

    protected function configure(): void
    {
        $this
            ->setDescription($this::DEFAULT_DESCRIPTION)
            ->setHelp($this::HELP_DESCRIPTION)
            ->addArgument('name', InputArgument::OPTIONAL)
            ->addArgument('sell_in', InputArgument::OPTIONAL)
            ->addArgument('quality', InputArgument::OPTIONAL)
            ->addArgument('days', InputArgument::OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $sellIn = $input->getArgument('sell_in');
        $quality = $input->getArgument('quality');
        $days = $input->getArgument('days');

        $helper = $this->getHelper('question');

        if (!isset($name)) {
            $itemNameQuestion = new Question($this::NAME_QUESTION);
            $name = $helper->ask($input, $output, $itemNameQuestion);
        }

        while (!isset($sellIn) || !is_numeric($sellIn)) {
            $itemSellInQuestion = new Question($this::SELL_IN_QUESTION);
            $sellIn = $helper->ask($input, $output, $itemSellInQuestion);
        }

        while (!isset($quality) || !is_numeric($quality)) {
            $itemQualityQuestion = new Question($this::QUALITY_QUESTION);
            $quality = $helper->ask($input, $output, $itemQualityQuestion);
        }

        while (!isset($days) || !is_numeric($days)) {
            $itemDaysPassedQuestion = new Question($this::DAYS_QUESTION);
            $days = $helper->ask($input, $output, $itemDaysPassedQuestion);
        }

        $item = [new Item($name, $sellIn, $quality)];

        $app = new GildedRose($item);

        for ($i = 0; $i < $days; $i++) {
            $app->updateQuality();            
        }

        $output->writeln([
            $this::HORIZONTAL_BAR_OUTPUT,
            $this::PROCESS_SUCCESS_OUTPUT,
            $this::NAME_OUTPUT . $item[0]->name,
            $this::SELL_IN_OUTPUT . $item[0]->sell_in . ' days',
            $this::QUALITY_OUTPUT . $item[0]->quality,
            $this::DAYS_OUTPUT . $days . ' days',
            $this::HORIZONTAL_BAR_OUTPUT
        ]);

        return Command::SUCCESS;
    }
}

$application->add(new CreateNewItemCommand());

$application->run();
