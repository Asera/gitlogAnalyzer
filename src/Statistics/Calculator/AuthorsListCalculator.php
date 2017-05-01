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
        $authors = new AuthorsListStatistics();
        /** @var LogRecord $statisticRecord */
        foreach ($statistics as $statisticRecord) {
            $authors->addAuthorToList($statisticRecord->getAuthor());
        }

        return $authors;
    }
}