<?php

use GitLogAnalyzer\Model\Author;
use GitLogAnalyzer\Model\FileChange;
use GitLogAnalyzer\Model\LogRecord;
use GitLogAnalyzer\Parser\HgLogRecordParser;
use PHPUnit\Framework\TestCase;

class HgLogRecordParserTest extends TestCase
{
    public function testGettingRecordFromFile() {
        /*
         * I don't think that side effects in test are good, but I don't see any other options now.
         * Will fix/rewrite it ASAP.
         */
        $fileHandler = fopen('tests/data/hg_log_records.log', 'r');
        $actual = $this->getActualLogRecord();

        $recordParser = new HgLogRecordParser();
        $expected = $recordParser->getRecordFromFile($fileHandler);
        $this->assertEquals($expected, $actual);
    }

    private function getActualLogRecord() {
        $result = new LogRecord();
        $author = new Author('The User', 'user@example.com');
        $fileChange = new FileChange();
        $change = $fileChange
            ->withFileName('Test/Core/File.php')
            ->withTotalRowsChanged(10);

        return $result
            ->withAuthor($author)
            ->withTime('Mon Mar 04 22:10:27 2017 +0200')
            ->withHash('14:deadbeef')
            ->withComment('test file for LogRecordParser')
            ->withTag('test')
            ->withChangeList([$change])
            ->withTotalStatistics(1, 5, 5);
    }
}
