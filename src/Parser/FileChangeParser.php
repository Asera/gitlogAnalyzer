<?php

namespace GitLogAnalyzer\Parser;

use GitLogAnalyzer\Model\FileChange;

class FileChangeParser
{
    public function getFileChangeFromLine($line) {
        $fileChange = new FileChange();
        $totalRowsChanged = $this->getTotalRowsChanged($line);
        $fileName = $this->getFileName($line);

        return $fileChange
            ->withFileName($fileName)
            ->withTotalRowsChanged($totalRowsChanged);
    }

    private function getTotalRowsChanged($line) {
        $totalRowsChangedRegex = '/.*\|\s+(\d*)/';
        if (preg_match($totalRowsChangedRegex, $line, $result) && ($result[1] !== '')) {
            return $result[1];
        }

        return 0;
    }

    private function getFileName($line) {
        $fileNameRegex = '/^(.*)\|/';
        preg_match($fileNameRegex, $line, $result);

        return trim($result[1]);
    }
}