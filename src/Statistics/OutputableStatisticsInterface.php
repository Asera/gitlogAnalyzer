<?php

namespace GitLogAnalyzer\Statistics;

use Symfony\Component\Console\Output\OutputInterface;

interface OutputableStatisticsInterface
{
    public function printAggregatedStatistics(OutputInterface $output);
}