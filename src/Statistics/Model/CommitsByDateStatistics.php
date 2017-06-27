<?php

namespace GitLogAnalyzer\Statistics\Model;

use GitLogAnalyzer\Model\LogRecord;

class CommitsByDateStatistics
{
    private $commitsByDate = [];

    public function addCommitToStatistics(LogRecord $statisticRecord) {
        $commitDate = $statisticRecord->getChangeDate()->format('Y-m-d');

        if (isset($this->commitsByDate[$commitDate])) {
            $this->commitsByDate[$commitDate]['total'] += $statisticRecord->getTotalLinesChanged();
            $this->commitsByDate[$commitDate]['added'] += $statisticRecord->getAddedLines();
            $this->commitsByDate[$commitDate]['removed'] += $statisticRecord->getRemovedLines();
        } else {
            $this->commitsByDate[$commitDate]['total'] = $statisticRecord->getTotalLinesChanged();
            $this->commitsByDate[$commitDate]['added'] = $statisticRecord->getAddedLines();
            $this->commitsByDate[$commitDate]['removed'] = $statisticRecord->getRemovedLines();
        }
    }

    public function getCommitsAggregatedByMonth(): array {
        $commitsByMonth = [];

        foreach ($this->commitsByDate as $date => $commit) {
            $dateObject = new \DateTime($date);

            $monthIdentifier = $dateObject->format('Y M');
            if (isset($commitsByMonth[$monthIdentifier])) {
                $commitsByMonth[$monthIdentifier]['total'] += $commit['total'];
                $commitsByMonth[$monthIdentifier]['added'] += $commit['added'];
                $commitsByMonth[$monthIdentifier]['removed'] += $commit['removed'];
            } else {
                $commitsByMonth[$monthIdentifier]['total'] = $commit['total'];
                $commitsByMonth[$monthIdentifier]['added'] = $commit['added'];
                $commitsByMonth[$monthIdentifier]['removed'] = $commit['removed'];
            }
        }

        return $commitsByMonth;
    }
}