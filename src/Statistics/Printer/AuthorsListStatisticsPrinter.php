<?php

namespace GitLogAnalyzer\Statistics\Printer;

use GitLogAnalyzer\Statistics\Model\AuthorsListStatistics;
use GitLogAnalyzer\Statistics\OutputableStatisticsInterface;
use Symfony\Component\Console\Helper\Table;
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
        $table = new Table($output);
        $table->setHeaders(['Name', 'Email', 'Commits Total']);

        $rowCounter = 0;
        foreach ($this->authorsStatistics->getAuthorsList() as $author) {
            $row = [
                $author->getName(),
                $author->getEmail(),
                $author->getCommitsNumber()
            ];
            $table->setRow($rowCounter, $row);
            $rowCounter++;
        }

        $table->render();
    }
}