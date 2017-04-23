<?php

namespace GitLogAnalyzer\Statistics\Calculator;

use GitLogAnalyzer\Model\LogRecord;

interface StatisticsCalculatorInterface
{
    /**
     * @param LogRecord[] $statistics
     * @return mixed
     */
    public function calculateStatistics(array $statistics);
}