<?php

namespace GitLogAnalyzer\Statistics\Printer;

use GitLogAnalyzer\Statistics\Model\CommitsByDateStatistics;
use GitLogAnalyzer\Statistics\OutputableStatisticsInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class CommitsByDateStatisticsPrinter implements OutputableStatisticsInterface
{
    private $commitsByDateStatistics = [];

    public function __construct(CommitsByDateStatistics $commitsByDateStatistics) {
        $this->commitsByDateStatistics = $commitsByDateStatistics;
    }

    public function printAggregatedStatistics(OutputInterface $output) {
        $table = new Table($output);
        $table->setHeaders(['Year', 'Month', 'Total changed', 'Added', 'Removed']);

        $rowCounter = 0;
        $monthlyAggregatedStatistics = $this->commitsByDateStatistics->getCommitsAggregatedByMonth();
        foreach ($monthlyAggregatedStatistics as $date => $dateStatistic) {
            $dateObject = new \DateTime($date);

            $year = $dateObject->format('Y');
            $month = $dateObject->format('M');

            $table->setRow($rowCounter, [
                $year,
                $month,
                $dateStatistic['total'],
                $dateStatistic['added'],
                $dateStatistic['removed']
            ]);
            $rowCounter++;
        }

        $table->render();
    }
}