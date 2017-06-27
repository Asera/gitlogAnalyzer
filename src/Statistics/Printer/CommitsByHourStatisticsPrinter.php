<?php

namespace GitLogAnalyzer\Statistics\Printer;

use GitLogAnalyzer\Statistics\Model\CommitsByHoursStatistics;
use GitLogAnalyzer\Statistics\OutputableStatisticsInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class CommitsByHourStatisticsPrinter implements OutputableStatisticsInterface
{
    private $commitsByHoursStatistics;

    public function __construct(CommitsByHoursStatistics $commitsByHoursStatistics) {
        $this->commitsByHoursStatistics = $commitsByHoursStatistics;
    }

    public function printAggregatedStatistics(OutputInterface $output) {
        $table = new Table($output);
        $table->setHeaders(['Hour', 'Total changed', 'Added', 'Removed']);

        $rowCounter = 0;
        $commitsByHoursStatisticsList = $this->commitsByHoursStatistics->getCommitsByHours();
        foreach ($commitsByHoursStatisticsList as $hour => $hourStatistic) {

            $table->setRow($rowCounter, [
                $hour,
                $hourStatistic['total'],
                $hourStatistic['added'],
                $hourStatistic['removed']
            ]);
            $rowCounter++;
        }

        $table->render();
    }
}