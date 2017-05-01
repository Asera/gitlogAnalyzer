<?php

namespace GitLogAnalyzer\Model;

class Author
{
    private $email;
    private $name;
    private $commitsNumber;

    public function __construct($name, $email = '', $commitsNumber = 1) {
        $this->name = $name;
        $this->email = $email;
        $this->commitsNumber = $commitsNumber;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getCommitsNumber() {
        return $this->commitsNumber;
    }

    public function increaseCommitsNumber() {
        $this->commitsNumber++;
    }
}