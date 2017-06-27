<?php

namespace GitLogAnalyzer\Statistics\Calculator;

use GitLogAnalyzer\Model\LogRecord;
use GitLogAnalyzer\Statistics\Model\CommitsByHoursStatistics;

class CommitsByHourStatisticsCalculator implements StatisticsCalculatorInterface
{

    /**
     * @param LogRecord[] $statistics
     * @return CommitsByHoursStatistics
     */
    public function calculateStatistics(array $statistics): CommitsByHoursStatistics {
        $commitsByHour = new CommitsByHoursStatistics();

        foreach ($statistics as $statisticRecord) {
            $commitsByHour->addCommitToStatistics($statisticRecord);
        }

        return $commitsByHour;
    }
}