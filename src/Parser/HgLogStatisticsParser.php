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
            $changesList[] = $logRecordParser->getRecordFromFile($handler);
        }

        return $changesList;
    }
}