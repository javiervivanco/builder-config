#!/usr/bin/env php
<?php
require 'vendor/autoload.php';


use JavierVivanco\BuilderConfig;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new BuilderConfig\Command\BuilderCommand());
$application->run();
