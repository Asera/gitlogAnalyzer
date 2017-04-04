<?php

namespace GitLogAnalyzer\Parser;

use GitLogAnalyzer\Model\LineType;
use GitLogAnalyzer\Model\LogRecord;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class HgLogRecordParser
{
    /**
     * @param resource $fileHandler
     * @return LogRecord
     */
    public function getRecordFromFile($fileHandler) {
        $result = new LogRecord();

        while (!feof($fileHandler)) {
            $line = fgets($fileHandler);
            if ($this->recordFullyParsedFromFile($line)) {
                return $result;
            }
            $result = $this->setDataToResult($result, $line);
        }

        return $result;
    }

    private function setDataToResult(LogRecord $result, $line) {
        $lineType = $this->getLineType($line);
        $rawLineData = $this->extractRawDataFromLine($line, $lineType);

        return $this->addLineDataToResultByLineType($result, $lineType, $rawLineData);
    }

    private function recordFullyParsedFromFile($line) {
        return trim($line) == '';
    }

    private function getLineType($line) {
        $lineTypeRegex = '/(.*?):/';

        if (preg_match($lineTypeRegex, $line, $result)) {
            switch ($result[1]) {
                case 'changeset':
                    return LineType::LINE_TYPE_CHANGESET;
                case 'tag':
                    return LineType::LINE_TYPE_TAG;
                case 'user':
                    return LineType::LINE_TYPE_USER;
                case 'date':
                    return LineType::LINE_TYPE_DATE;
                case 'summary':
                    return LineType::LINE_TYPE_SUMMARY;
            }
        }

        if (strpos($line, '|') !== false) {
            return LineType::LINE_TYPE_FILE_CHANGE;
        }

        $totalStatisticsRegex = '/\d+ files changed, \d+ insertions\(\+\), \d+ deletions\(-\)/';
        if (preg_match($totalStatisticsRegex, $line)) {
            return LineType::LINE_TYPE_TOTAL_STATISTICS;
        }
        $logger = new Logger('parser');
        $logger->pushHandler(new StreamHandler('log/parser.log'));
        $logger->addWarning('Unsupported line type in line.', ['line' => $line]);
        return LineType::LINE_TYPE_UNSUPPORTED;
    }

    private function extractRawDataFromLine($line, $lineType) {
        if ($lineType == LineType::LINE_TYPE_FILE_CHANGE) {
            $fileChangeParser = new FileChangeParser();
            return $fileChangeParser->getFileChangeFromLine($line);
        }

        if ($lineType == LineType::LINE_TYPE_TOTAL_STATISTICS) {
            $totalStatisticsRegex = '/(?<changed>\d+) files changed, (?<insertions>\d+) insertions\(\+\), (?<deletions>\d+) deletions\(-\)/';
            preg_match($totalStatisticsRegex, $line, $result);
            return $result;
        }

        $lineDataRegex = '/.*?:(.*)$/';
        preg_match($lineDataRegex, $line, $result);
        return trim($result[1]);
    }

    private function addLineDataToResultByLineType(LogRecord $result, $lineType, $lineData) {
        switch ($lineType) {
            case LineType::LINE_TYPE_CHANGESET:
                return $result->withHash($lineData);
            case LineType::LINE_TYPE_USER:
                return $result->withAuthor($lineData);
            case LineType::LINE_TYPE_DATE:
                return $result->withTime($lineData);
            case LineType::LINE_TYPE_TAG:
                return $result->withTag($lineData);
            case LineType::LINE_TYPE_SUMMARY:
                return $result->withComment($lineData);
            case LineType::LINE_TYPE_FILE_CHANGE:
                $result->addChange($lineData);
                return $result;
            case LineType::LINE_TYPE_TOTAL_STATISTICS:
                return $result->withTotalStatistics(
                    $lineData['changed'],
                    $lineData['insertions'],
                    $lineData['deletions']
                );
        }

        return $result;
    }
}