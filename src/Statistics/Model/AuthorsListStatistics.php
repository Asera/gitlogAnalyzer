<?php

namespace GitLogAnalyzer\Statistics\Model;

use GitLogAnalyzer\Model\Author;

class AuthorsListStatistics
{
    /**
     * @var Author[]
     */
    private $authorsList = [];

    public function addAuthorToList(Author $author) {
        if(!isset($this->authorsList[$author->getName()])) {
            $this->authorsList[$author->getName()] = $author;
        } else {
            $this->addCommitToAuthor($author);
        }
    }

    public function getAuthorsList() {
        return $this->authorsList;
    }

    private function addCommitToAuthor(Author $author) {
        $this->authorsList[$author->getName()]->increaseCommitsNumber();
    }
}