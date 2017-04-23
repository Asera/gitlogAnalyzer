<?php

namespace GitLogAnalyzer\Statistics\Printer;

use GitLogAnalyzer\Statistics\Model\AuthorsListStatistics;
use GitLogAnalyzer\Statistics\OutputableStatisticsInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AuthorsListStatisticsPrinter implements OutputableStatisticsInterface
{
    /**
     * @var AuthorsListStatistics
     */
    private $authorsStatistics;

    public function __construct(AuthorsListStatistics $authorsStatistics) {
        $this->authorsStatistics = $authorsStatistics;
    }

    public function printAggregatedStatistics(OutputInterface $output) {
        foreach ($this->authorsStatistics->getAuthorsList() as $author) {
            $output->writeln($author);
        }
    }
}