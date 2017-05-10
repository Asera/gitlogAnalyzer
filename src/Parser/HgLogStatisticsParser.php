<?php

namespace GitLogAnalyzer\Parser;

use GitLogAnalyzer\Model\LogRecord;

class HgLogStatisticsParser
{
    /**
     * @param string $file
     * @return LogRecord[]
     */
    public function parse($file) {
        $handler = fopen($file, 'r');

        $logRecordParser = new HgLogRecordParser();
        $changesList = [];
        while(!feof($handler)) {
            $record = $logRecordParser->getRecordFromFile($handler);
            if ($this->isRecordFull($record)) {
                $changesList[] = $record;
            }
        }

        return $changesList;
    }

    private function isRecordFull(LogRecord $logRecord): bool {
        return !is_null($logRecord->getAuthorName());
    }
}