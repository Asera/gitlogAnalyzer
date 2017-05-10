<?php

namespace GitLogAnalyzer\Statistics\Model;

use GitLogAnalyzer\Model\Author;
use GitLogAnalyzer\Model\LogRecord;

class AuthorsListStatistics
{
    /**
     * @var Author[]
     */
    private $authorsList = [];

    public function addCommitToAuthorsStatistics(LogRecord $statisticRecord) {
        if(!$this->isAuthorInList($statisticRecord->getAuthorName())) {
            $this->addAuthorToList($statisticRecord->getAuthorName(), $statisticRecord->getAuthorEmail());
        }
        $this->authorsList[$statisticRecord->getAuthorName()]->addCommitToAuthor($statisticRecord);
    }

    private function isAuthorInList(string $authorName): bool {
        return isset($this->authorsList[$authorName]);
    }

    private function addAuthorToList(string $authorName, string $authorEmail) {
        $this->authorsList[$authorName] = new Author($authorName, $authorEmail);
    }

    public function getAuthorsList() {
        return $this->authorsList;
    }
}