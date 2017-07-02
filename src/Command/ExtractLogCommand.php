<?php

namespace GitLogAnalyzer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExtractLogCommand extends Command
{
    protected function configure() {
        $this->setName('extract-log-command');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('Command for extracting mercurial log in file: hg log --stat > somefile.log');
    }
}