<?php

namespace GitLogAnalyzer\Model;

class Author
{
    private $email;
    private $name;
    private $commitsList = [];

    public function __construct($name, $email = '', $commitsList = []) {
        $this->name = $name;
        $this->email = $email;
        $this->commitsList = $commitsList;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getCommitsNumber(): int {
        return count($this->commitsList);
    }

    public function addCommitToAuthor(LogRecord $commit) {
        if (!isset($this->commitsList[$commit->getHash()])) {
            $this->commitsList[$commit->getHash()] = $commit;
        }
    }

    public function getFirstCommitDate(): \DateTime {
        return array_reduce($this->commitsList, function (\DateTime $result, LogRecord $commit) {
            $changeDate = $commit->getChangeDate();
            if ($result->getTimestamp() < $changeDate->getTimestamp()) {
                return $result;
            }
            return $changeDate;
        }, new \DateTime());
    }

    public function getLastCommitDate(): \DateTime {
        $start_time = new \DateTime();
        $start_time->setTimestamp(0);
        return array_reduce($this->commitsList, function (\DateTime $result, LogRecord $commit) {
            $changeDate = $commit->getChangeDate();
            if ($result->getTimestamp() > $changeDate->getTimestamp()) {
                return $result;
            }
            return $changeDate;
        }, $start_time);
    }
}