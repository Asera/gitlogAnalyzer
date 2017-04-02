<?php

namespace GitLogAnalyzer\Model;

class FileChange
{
    private $fileName;
    private $deletedRowsCount;
    private $addedRowsCount;
    private $totalRowsChanged;

    public function __construct() {

    }

    public function withFileName($fileName) {
        $result = clone $this;
        $result->fileName = $fileName;
        return $result;
    }

    public function withDeletedRowsCount($deletedRowsCount) {
        $result = clone $this;
        $result->deletedRowsCount = $deletedRowsCount;
        return $result;
    }

    public function withAddedRowsCount($addedRowsCount) {
        $result = clone $this;
        $result->addedRowsCount = $addedRowsCount;
        return $result;
    }

    public function withTotalRowsChanged($totalRowsChanged) {
        $result = clone $this;
        $result->totalRowsChanged = $totalRowsChanged;
        return $result;
    }
}