<?php
namespace Command;

use Ouzo\Tools\Controller\Template\ControllerGenerator;
use Ouzo\Tools\Controller\Template\ViewGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ControllerGeneratorCommand extends Command
{
    /**
     * @var InputInterface
     */
    private $input;
    /**
     * @var OutputInterface
     */
    private $output;

    public function configure()
    {
        $this->setName('ouzo:controller_generator')
            ->addArgument('controller', InputArgument::REQUIRED, 'Controller name')
            ->addArgument('action', InputArgument::OPTIONAL, 'Action name');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->generate();
    }

    private function generate()
    {
        $controller = $this->input->getArgument('controller');
        $action = $this->input->getArgument('action');
        $controllerGenerator = new ControllerGenerator($controller);
        $this->output->writeln('---------------------------------');
        $this->output->writeln('Class name: <info>' . $controllerGenerator->getClassName() . '</info>');
        $this->output->writeln('Class namespace: <info>' . $controllerGenerator->getClassNamespace() . '</info>');
        $this->output->writeln('---------------------------------');
        if (!$controllerGenerator->isControllerExists()) {
            $this->output->writeln('Create: <info>' . $controllerGenerator->getControllerPath() . '</info>');
            $this->output->writeln($controllerGenerator->templateContents());
            $controllerGenerator->saveController();
        }

        $viewGenerator = new ViewGenerator($controller);
        if ($viewGenerator->createViewDirectoryIfNotExists()) {
            $this->output->writeln('Create: <info>' . $viewGenerator->getViewPath() . '</info>');
        }
        if ($action) {

        }
    }
}
