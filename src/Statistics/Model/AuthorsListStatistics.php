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
        if(!in_array($author, $this->authorsList)) {
            $this->authorsList[] = $author;
        }
    }

    public function getAuthorsList() {
        return $this->authorsList;
    }
}