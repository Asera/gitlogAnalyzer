<?php

namespace GitLogAnalyzer\Parser;

use GitLogAnalyzer\Model\GitLogRecord;

class GitLogStatisticsParser
{
    /**
     * @param string $file
     * @return GitLogRecord[]
     */
    public function parse($file) {
        $handler = fopen($file, 'r');

        $logRecordParser = new GitLogRecordParser();
        $changesList = [];
        while(!feof($handler)) {
            $changesList[] = $logRecordParser->getRecordFromFile($handler);
        }

        return $changesList;
    }
}