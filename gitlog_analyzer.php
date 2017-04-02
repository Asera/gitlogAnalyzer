<?php
use GitLogAnalyzer\Command\AnalyzeGitLogCommand;
use Symfony\Component\Console\Application;

require __DIR__.'/vendor/autoload.php';

$application = new Application();
$application->add(new AnalyzeGitLogCommand());
$application->run();