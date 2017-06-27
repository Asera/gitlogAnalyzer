<?php

namespace GitLogAnalyzer\Statistics\Model;

use GitLogAnalyzer\Model\LogRecord;

class CommitsByHoursStatistics
{
    private $commitsByHour = [];

    public function addCommitToStatistics(LogRecord $statisticRecord) {
        $commitHour = $statisticRecord->getChangeDate()->format('H');

        if (isset($this->commitsByHour[$commitHour])) {
            $this->commitsByHour[$commitHour]['total'] += $statisticRecord->getTotalLinesChanged();
            $this->commitsByHour[$commitHour]['added'] += $statisticRecord->getAddedLines();
            $this->commitsByHour[$commitHour]['removed'] += $statisticRecord->getRemovedLines();
        } else {
            $this->commitsByHour[$commitHour]['total'] = $statisticRecord->getTotalLinesChanged();
            $this->commitsByHour[$commitHour]['added'] = $statisticRecord->getAddedLines();
            $this->commitsByHour[$commitHour]['removed'] = $statisticRecord->getRemovedLines();
        }

        ksort($this->commitsByHour);
    }

    public function getCommitsByHours(): array {
        return $this->commitsByHour;
    }
}