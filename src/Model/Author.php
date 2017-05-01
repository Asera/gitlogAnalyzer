<?php

namespace GitLogAnalyzer\Model;

class Author
{
    private $email;
    private $name;

    public function __construct($name, $email = '') {
        $this->name = $name;
        $this->email = $email;
    }

    public function toArray() {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}