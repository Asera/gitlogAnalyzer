<?php

namespace GitLogAnalyzer\Statistics\Calculator;


use GitLogAnalyzer\Model\LogRecord;
use GitLogAnalyzer\Statistics\Model\CommitsByDateStatistics;

class CommitsDateStatisticsCalculator implements StatisticsCalculatorInterface
{

    /**
     * @param LogRecord[] $statistics
     * @return CommitsByDateStatistics
     */
    public function calculateStatistics(array $statistics): CommitsByDateStatistics {
        $commitsByDate = new CommitsByDateStatistics();

        foreach ($statistics as $statisticRecord) {
            $commitsByDate->addCommitToStatistics($statisticRecord);
        }

        return $commitsByDate;
    }
}