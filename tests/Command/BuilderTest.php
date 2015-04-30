<?php 

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

use JavierVivanco\BuilderConfig\Command;

class BuilderTest extends  \PHPUnit_Framework_TestCase
{
    protected $application;
    protected $command;
    public function setUp(){
        $this->application = new Application();
        $this->application->add(new Command\BuilderCommand());
        $this->command = $this->application->find('build');

    }

    public function testExecute()
    {
        $commandTester = new CommandTester($this->command);
        array()/*array('build' => $command->getName())*/
        $args['role'] = FILE_ROLE_TEST;
        $args['dir']  = DIR_TEMPLATE;
        $commandTester->execute($args);
        $this->assertRegExp('/.../', $commandTester->getDisplay());
        $display = $commandTester->getDisplay();
        

    }
}