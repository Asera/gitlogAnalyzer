<?php

namespace GitLogAnalyzer\Model;

class LogRecord
{
    private $commitNumber;
    /**
     * @var Author
     */
    private $author;
    private $comment;
    private $changeList;
    private $time;
    private $hash;
    private $tag;
    private $changedFilesCount;
    private $addedLinesCount;
    private $removedLinesCount;

    public function __construct() {

    }

    public function withCommitNumber($commitNumber) {
        $result = clone $this;
        $result->commitNumber = $commitNumber;
        return $result;
    }

    public function withAuthor(Author $author) {
        $result = clone $this;
        $result->author = $author;
        return $result;
    }

    public function withComment($comment) {
        $result = clone $this;
        $result->comment = $comment;
        return $result;
    }

    public function withChangeList(array $changeList) {
        $result = clone $this;
        $result->changeList = $changeList;
        return $result;
    }

    public function addChange(FileChange $change) {
        $this->changeList[] = $change;
    }

    public function withTime($time) {
        $result = clone $this;
        $result->time = $time;
        return $result;
    }

    public function withHash($hash) {
        $result = clone $this;
        $result->hash = $hash;
        return $result;
    }

    public function withTag($tag) {
        $result = clone $this;
        $result->tag = $tag;
        return $result;
    }

    public function withTotalStatistics(int $filesChanged, int $insertions, int $deletions) {
        $result = clone $this;
        $result->changedFilesCount = $filesChanged;
        $result->addedLinesCount = $insertions;
        $result->removedLinesCount = $deletions;
        return $result;
    }

    /**
     * @return Author
     */
    public function getAuthor() {
        return $this->author;
    }

    public function getChangedFilesCount() {
        return $this->changedFilesCount;
    }
}