<?php

namespace GitLogAnalyzer\Statistics\Calculator;

use GitLogAnalyzer\Model\LogRecord;
use GitLogAnalyzer\Statistics\Model\AuthorsListStatistics;

class AuthorsListCalculator implements StatisticsCalculatorInterface
{
    /**
     * @param LogRecord[] $statistics
     * @return AuthorsListStatistics
     */
    public function calculateStatistics(array $statistics) {
        $authorsStatistics = new AuthorsListStatistics();
        /** @var LogRecord $statisticRecord */
        foreach ($statistics as $statisticRecord) {
            $authorsStatistics->addCommitToAuthorsStatistics($statisticRecord);
        }

        return $authorsStatistics;
    }
}