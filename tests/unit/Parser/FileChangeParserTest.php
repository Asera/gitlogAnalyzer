<?php

use GitLogAnalyzer\Model\FileChange;
use GitLogAnalyzer\Parser\FileChangeParser;
use PHPUnit\Framework\TestCase;

class FileChangeParserTest extends TestCase
{
    /**
     * @dataProvider parsingFileChangeLineProvider
     * @param $line
     * @param FileChange $expected
     */
    public function testParsingFileChangeLine($line, FileChange $expected) {
        $fileChangeParser = new FileChangeParser();
        $result = $fileChangeParser->getFileChangeFromLine($line);
        $this->assertEquals($expected, $result);
    }

    public function parsingFileChangeLineProvider() {
        $fileChange = new FileChange();
        return [
            'Normal line of text file' => [
                'src/Parser/HgLogStatisticsParser.php                               |   11 +-------- ',
                $fileChange->withFileName('src/Parser/HgLogStatisticsParser.php')->withTotalRowsChanged(11),
            ],
            'Line with non-text file' => [
                'some/kind/of/picture.png                             |  Bin ',
                $fileChange->withFileName('some/kind/of/picture.png')->withTotalRowsChanged(0),
            ]
        ];
    }
}
