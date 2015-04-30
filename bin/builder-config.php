#!/usr/bin/env php
<?php
require 'vendor/autoload.php';


use JavierVivanco\BuilderConfig;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Command\BuilderCommand());
$application->run();
