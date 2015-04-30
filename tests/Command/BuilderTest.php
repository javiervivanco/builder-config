<?php 

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

use JavierVivanco\BuilderConfig\Command;

class BuilderTest extends  \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new Command\BuilderCommand());

        $command = $application->find('build');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('build' => $command->getName()));

        $this->assertRegExp('/.../', $commandTester->getDisplay());

        // ...
    }
}