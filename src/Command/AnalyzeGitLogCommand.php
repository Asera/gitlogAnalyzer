<?php

namespace GitLogAnalyzer\Command;

use GitLogAnalyzer\Parser\HgLogStatisticsParser;
use GitLogAnalyzer\Statistics\Calculator\AuthorsListCalculator;
use GitLogAnalyzer\Statistics\Printer\AuthorsListStatisticsPrinter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalyzeGitLogCommand extends Command
{
    protected function configure()
    {
        $this->setName('analyze-log')
            ->addArgument(
                'logfile',
                InputArgument::REQUIRED,
                'Path to file with git log'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Preparing statistics parser.');
        $statisticsParser = new HgLogStatisticsParser();
        $gitLogInput = $input->getArgument('logfile');

        $output->writeln('Parsing git log file.');
        $gitLogRecordsList = $statisticsParser->parse($gitLogInput);

        $output->writeln('Calculating statistics.');
        $authorsListCalculator = new AuthorsListCalculator();
        $authorsStatistics = $authorsListCalculator->calculateStatistics($gitLogRecordsList);

        $output->writeln('Formatting output.');
        $authorsPrinter = new AuthorsListStatisticsPrinter($authorsStatistics);
        $authorsPrinter->printAggregatedStatistics($output);

        $output->writeln('Yarrr!');
    }
}