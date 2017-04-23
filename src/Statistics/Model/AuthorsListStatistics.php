<?php

namespace GitLogAnalyzer\Statistics\Model;

class AuthorsListStatistics
{
    private $authorsList = [];

    public function addAuthorToList($author) {
        if(!in_array($author, $this->authorsList)) {
            $this->authorsList[] = $author;
        }
    }

    public function getAuthorsList() {
        return $this->authorsList;
    }
}