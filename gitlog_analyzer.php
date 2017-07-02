<?php
use GitLogAnalyzer\Command\AnalyzeGitLogCommand;
use GitLogAnalyzer\Command\ExtractLogCommand;
use Symfony\Component\Console\Application;

require __DIR__.'/vendor/autoload.php';

$application = new Application();
$application->add(new AnalyzeGitLogCommand());
$application->add(new ExtractLogCommand());
$application->run();