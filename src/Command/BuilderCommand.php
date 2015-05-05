<?php 

namespace JavierVivanco\BuilderConfig\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;
 
class BuilderCommand extends Command{
 protected function configure()
    {
        $this
            ->setName('build')
            ->setDescription('build')
            ->addArgument(
                'templates',
                InputArgument::REQUIRED,
                'Directory templates config'
            )
            ->addArgument(
                'dir',
                InputArgument::REQUIRED,
                'Directory builder config'
            )
            ->addArgument(
                'role',
                InputArgument::REQUIRED,
                'Role file with parameters'
            )            
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $role     = $input->getArgument('role');

        $templates = $input->getArgument('templates');
        $dir      = $input->getArgument('dir');
        if(!file_exists($templates)){
            throw new \Exception(sprintf("%s is not directory", $template));
        }
        $yaml         = new Parser();
        $values_roles = $yaml->parse(file_get_contents($role));
        $loader       = new \Twig_Loader_Filesystem($templates);
        $twig         = new \Twig_Environment($loader);

        $finder       = new Finder();
        $finder->files()->in($templates);
        $output->writeln('Building configurations:');
        foreach ($finder as $file) {
            $vars   = $values_roles['role'][$file->getRelativePathname()];
            $config = $twig->render($file->getRelativePathname(), $vars);
            $dir_config_file = sprintf("%s/%s", $dir, $file->getRelativePath());
            $config_file = sprintf("%s/%s", $dir, $file->getRelativePathname());
            if (!file_exists($dir_config_file)) {
                mkdir($dir_config_file, 0777, true );
            }
            file_put_contents($config_file, $config);
            $output->writeln(sprintf("  - %s", $file->getRelativePathname()));
            #$file->getRealpath()."\n";
        }

    }

}
