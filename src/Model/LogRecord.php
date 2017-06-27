<?php

namespace GitLogAnalyzer\Model;

class LogRecord
{
    private $commitNumber;
    private $authorName;
    private $authorEmail;
    private $comment;
    private $changeList;

    /**
     * @var \DateTime
     */
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

    public function withAuthorName(string $authorName): LogRecord {
        $result = clone $this;
        $result->authorName = $authorName;
        return $result;
    }

    public function withAuthorEmail(string $authorEmail): LogRecord {
        $result = clone $this;
        $result->authorEmail = $authorEmail;
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

    public function withTime(string $time): LogRecord {
        $result = clone $this;
        $result->time = new \DateTime($time);
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
     * @return string|null
     */
    public function getAuthorName() {
        return $this->authorName;
    }

    public function getAuthorEmail(): string {
        return $this->authorEmail;
    }

    public function getChangedFilesCount() {
        return $this->changedFilesCount;
    }

    public function getChangeDate(): \DateTime {
        return $this->time;
    }

    public function getHash(): string {
        return $this->hash;
    }

    public function getRemovedLines(): int {
        return $this->removedLinesCount;
    }

    public function getAddedLines(): int {
        return $this->addedLinesCount;
    }

    public function getTotalLinesChanged(): int {
        return $this->addedLinesCount + $this->removedLinesCount;
    }
}