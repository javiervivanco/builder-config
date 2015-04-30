<?php 

namespace JavierVivanco\BuilderConfig\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

 
class BuilderCommand extends Command{
 protected function configure()
    {
        $this
            ->setName('build')
            ->setDescription('build')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'set name for proyect'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = "down";
        $output->writeln($text);
    }
}
