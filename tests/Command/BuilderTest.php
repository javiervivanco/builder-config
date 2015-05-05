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
        #array()/*array('build' => $command->getName())*/
        $args['role']       = FILE_ROLE_TEST;
        $args['templates']  = DIR_TEMPLATE;
        $args['dir']        = $dir_test = sys_get_temp_dir();

        $commandTester->execute($args);
        #$this->assertRegExp('/.../', $commandTester->getDisplay());
        $display = $commandTester->getDisplay();
        $this->assertEquals($display, 
<<<DISPLAY
Building configurations:
  - config/test.config

DISPLAY
);
        $expect = 
<<<EXPECT
simple_var   = hello_word
complex_list =
    * one
    * two
    * three
var_condition = 0

EXPECT
;        
        $this->assertEquals($expect, file_get_contents($dir_test.'/config/test.config'));

    }
}
